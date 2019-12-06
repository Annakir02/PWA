<?php
namespace Yereone\Slider\Model;

use Magento\Framework\Model\AbstractModel;

class Slide extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yereone\Slider\Model\ResourceModel\Slide::class);
    }
}