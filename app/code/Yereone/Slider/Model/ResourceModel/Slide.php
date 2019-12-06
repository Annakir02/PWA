<?php
namespace Yereone\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Slide extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('slide', 'slide_id');
    }
}