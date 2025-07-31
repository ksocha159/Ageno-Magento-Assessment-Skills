<?php

namespace KSocha\CustomSku\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\ResourceConnection;
use Magento\Backend\Model\Auth\Session as AdminSession;

class LogCustomSkuChange implements ObserverInterface
{

    protected $resource;
    protected $adminSession;
    protected $customSkuLogFactory; 

    public function __construct(
            ResourceConnection $resource,
            AdminSession $adminSession,
            \KSocha\CustomSku\Model\CustomSkuLogFactory $customSkuLogFactory
    )
    {
        $this->resource = $resource;
        $this->adminSession = $adminSession;
        $this->customSkuLogFactory = $customSkuLogFactory;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if(!$product || !$product->getId())
        {
            return;
        }

        $oldValue = $product->getOrigData('custom_sku');
        $newValue = $product->getData('custom_sku');

        if($oldValue === $newValue)
        {
            return;
        }

//        $connection = $this->resource->getConnection();
//        $tableName = $this->resource->getTableName('ksocha_customsku_log');

        $adminUser = $this->adminSession->getUser();
        $userId = $adminUser ? $adminUser->getId() : null;

//        $connection->insert($tableName, [
//            'product_id' => $product->getId(),
//            'old_value' => $oldValue,
//            'new_value' => $newValue,
//            'user_id' => $userId,
//            'changed_at' => (new \DateTime())->format('Y-m-d H:i:s'),
//        ]);

        $log = $this->customSkuLogFactory->create();
        $log->setProductId($product->getId());
        $log->setOldValue($oldValue);
        $log->setNewValue($newValue);
        $log->setUserId($userId);
        $log->setChangedAt((new \DateTime())->format('Y-m-d H:i:s'));
        
//        
//        $log->setData([
//            'product_id' => $product->getId(),
//            'old_value' => $oldValue,
//            'new_value' => $newValue,
//            'user_id' => $userId,
//            'changed_at' => (new \DateTime())->format('Y-m-d H:i:s'),
//        ]);
        
        $log->save();
    }

}
