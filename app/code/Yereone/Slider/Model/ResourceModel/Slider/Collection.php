<?php
namespace Yereone\Slider\Model\ResourceModel\Slider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yereone\Slider\Model\Slider::class,
            \Yereone\Slider\Model\ResourceModel\Slider::class
        );
    }
}