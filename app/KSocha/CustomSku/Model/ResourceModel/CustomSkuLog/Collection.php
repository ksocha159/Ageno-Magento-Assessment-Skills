<?php
namespace KSocha\CustomSku\Model\ResourceModel\CustomSkuLog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'log_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('KSocha\CustomSku\Model\CustomSkuLog', 'KSocha\CustomSku\Model\ResourceModel\CustomSkuLog');
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            'main_table.user_id = admin_user.user_id',
            ['user' => new \Zend_Db_Expr("CONCAT(admin_user.firstname, ' ', admin_user.lastname)")]
        );
    }
 
}