<?php
namespace KSocha\CustomSku\Controller\Adminhtml\Log;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'KSocha_CustomSku::log';

    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('KSocha_CustomSku::log');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom SKU Log'));
        return $resultPage;
    }
}
