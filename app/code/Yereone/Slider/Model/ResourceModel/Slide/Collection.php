<?php
namespace Yereone\Slider\Model\ResourceModel\Slide;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yereone\Slider\Model\Slide::class,
            \Yereone\Slider\Model\ResourceModel\Slide::class
        );
    }
}