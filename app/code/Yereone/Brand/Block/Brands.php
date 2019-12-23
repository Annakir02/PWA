<?php
namespace Yereone\Brand\Block;

use Magento\Framework\View\Element\Template;

class Brands extends Template
{
    protected $_scopeConfig;
    protected $brandFactory;

    public function __construct(Template\Context $context, array $data = [],\Yereone\Brand\Model\BrandFactory $brandFactory)
    {
        parent::__construct($context, $data);
        $this->brandFactory = $brandFactory;
    }

    public function getBrands()
    {
        $brand = $this->brandFactory->create();
        $brands = $brand->getCollection();

        return $brands;

    }

}
