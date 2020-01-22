<?php
namespace Yereone\Brand\Block;

use Magento\Framework\View\Element\Template;

class Brands extends Template
{
    protected $_scopeConfig;
    protected $brandFactory;
    public $_storeManager;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Yereone\Brand\Model\BrandFactory $brandFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $data);
        $this->brandFactory = $brandFactory;
        $this->_storeManager = $storeManager;
    }

    public function getBrands()
    {
        $brand = $this->brandFactory->create();
        $brands = $brand->getCollection();

        return $brands;
    }

    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

}
