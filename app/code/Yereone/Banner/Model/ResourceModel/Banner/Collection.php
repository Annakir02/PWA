<?php
namespace Yereone\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yereone\Banner\Model\Banner::class,
            \Yereone\Banner\Model\ResourceModel\Banner::class
        );
    }
}