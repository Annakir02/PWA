<?php
namespace Yereone\Slider\Model;

use Magento\Framework\Model\AbstractModel;

class Slider extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yereone\Slider\Model\ResourceModel\Slider::class);
    }
}