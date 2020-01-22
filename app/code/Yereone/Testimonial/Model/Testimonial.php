<?php
namespace Yereone\Testimonial\Model;

use Magento\Framework\Model\AbstractModel;

class Testimonial extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yereone\Testimonial\Model\ResourceModel\Testimonial::class);
    }
}