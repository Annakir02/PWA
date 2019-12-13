<?php
namespace Yereone\Banner\Model;

use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yereone\Banner\Model\ResourceModel\Banner::class);
    }
}