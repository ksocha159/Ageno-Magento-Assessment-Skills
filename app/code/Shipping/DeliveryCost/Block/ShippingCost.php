<?php

namespace Shipping\DeliveryCost\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class ShippingCost extends Template
{
    protected $scopeConfig;
    protected $_priceCurrency;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_priceCurrency = $priceCurrency;
        parent::__construct($context, $data);
    }

    public function getShippingCost()
    {

        $value = $this->scopeConfig->getValue(
            'carriers/flatrate/price',
            ScopeInterface::SCOPE_STORE
        );

        if (is_numeric($value)) {
            return number_format((float)$value, 2, ',', '');
        }

        return null;
    }
    
    public function getCurrentCurrencySymbol()
    {
        return $this->_priceCurrency->getCurrency()->getCurrencySymbol();
    }
}
