<?php

namespace KSocha\CustomSku\Api\Data;

interface CustomSkuLogInterface
{

    const LOG_ID = 'log_id';
    const PRODUCT_ID = 'product_id';
    const OLD_VALUE = 'old_value';
    const NEW_VALUE = 'new_value';
    const USER_ID = 'user_id';
    const CHANGED_AT = 'changed_at';

    public function getLogId();
    public function setLogID($log_id);

    public function getProductId();
    public function setProductId($product_id);

    public function getOldValue();
    public function setOldValue($old_value);


    public function getNewValue();
    public function setNewValue($new_value);


    public function getUserId();
    public function setUserId($user_id);


    public function getChangedAt();
    public function setChangedAt($changed_at);
}
