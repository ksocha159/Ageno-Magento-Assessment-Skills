<?php
namespace KSocha\CustomSku\Model;

use Magento\Framework\Model\AbstractModel;
use KSocha\CustomSku\Api\Data\CustomSkuLogInterface;
class CustomSkuLog extends AbstractModel implements CustomSkuLogInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'ks_customsku_log';

    /**
     * @var string
     */
    protected $_cacheTag = 'ks_customsku_log';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'ks_customsku_log';
    
    
    protected function _construct()
    {
        $this->_init(\KSocha\CustomSku\Model\ResourceModel\CustomSkuLog::class);
    }
    
    
    public function getLogId()
    {
        return $this->getData(self::LOG_ID);
    }
    public function setLogId($log_id)
    {
        return $this->setData(self::LOG_ID, $log_id);
    }
    
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }
    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }
    
    public function getOldValue()
    {
        return $this->getData(self::OLD_VALUE);
    }
    public function setOldValue($old_value)
    {
        return $this->setData(self::OLD_VALUE, $old_value);
    }
        
    public function getNewValue()
    {
        return $this->getData(self::NEW_VALUE);
    }
    public function setNewValue($new_value)
    {
        return $this->setData(self::NEW_VALUE, $new_value);
    }
        
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }
    public function setUserId($user_id)
    {
        return $this->setData(self::USER_ID, $user_id);
    }
        
    public function getChangedAt()
    {
        return $this->getData(self::CHANGED_AT);
    }
    public function setChangedAt($changed_at)
    {
        return $this->setData(self::CHANGED_AT, $changed_at);
    }
    
}
