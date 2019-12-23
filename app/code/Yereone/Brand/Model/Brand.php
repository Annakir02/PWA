<?php
namespace Yereone\Brand\Model;

use Magento\Framework\Model\AbstractModel;

class Brand extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yereone\Brand\Model\ResourceModel\Brand::class);
    }
}