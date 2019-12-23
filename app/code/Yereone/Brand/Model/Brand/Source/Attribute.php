<?php
namespace Yereone\Brand\Model\Brand\Source;

use \Magento\Framework\Option\ArrayInterface;

class Attribute  implements ArrayInterface
{
    protected $_scopeConfig;

    function __construct(\Magento\Eav\Model\Config $eavConfig,\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->eavConfig = $eavConfig;
        $this->_scopeConfig = $scopeConfig;
    }

    public function toOptionArray()
    {
        $brand = $this->_scopeConfig->getValue('brand/general/attribute', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $attribute = $this->eavConfig->getAttribute('catalog_product', $brand);
        $options = $attribute->getSource()->getAllOptions();

        return $options;
    }

    public function toArray()
    {
        $options = $this->toOptionArray();
        $return = [];

        foreach ($options as $option) {
            $return[$option['value']] = $option['label'];
        }

        return $return;
    }
}
