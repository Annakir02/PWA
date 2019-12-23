<?php
namespace Yereone\Brand\Model\ResourceModel\Brand;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yereone\Brand\Model\Brand::class,
            \Yereone\Brand\Model\ResourceModel\Brand::class
        );
    }
}