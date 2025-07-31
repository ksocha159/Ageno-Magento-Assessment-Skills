<?php
namespace KSocha\CustomSku\Cron;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use KSocha\CustomSku\Model\ResourceModel\CustomSkuLog\CollectionFactory as LogCollectionFactory;
use KSocha\CustomSku\Model\CustomSkuLogFactory;

class CleanOldLogs
{
    const XML_PATH_LOG_LIFETIME = 'customsku/log_settings/log_lifetime_days';

    protected $scopeConfig;
    protected $logger;
    protected $logCollectionFactory;
    protected $logFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger,
        LogCollectionFactory $logCollectionFactory,
        CustomSkuLogFactory $logFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->logCollectionFactory = $logCollectionFactory;
        $this->logFactory = $logFactory;
    }

    public function execute()
    {
        try {
            $days = (int) $this->scopeConfig->getValue(
                self::XML_PATH_LOG_LIFETIME,
                ScopeInterface::SCOPE_STORE
            );
            if ($days <= 0) {
                $days = 2;
            }

            $cutoffDate = (new \DateTime())->modify("-{$days} days")->format('Y-m-d H:i:s');

            $collection = $this->logCollectionFactory->create();
            $collection->addFieldToFilter('changed_at', ['lt' => $cutoffDate]);

            $deletedCount = 0;

            foreach ($collection as $logEntry) {
                $logEntry->delete();
                $deletedCount++;
            }

            $this->logger->info("Deleted {$deletedCount} log record(s) older than {$days} day(s).");
        } catch (\Exception $e) {
            $this->logger->error("Error during log cleanup - " . $e->getMessage());
        }
    }
}
