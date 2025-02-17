<?php
namespace Yereone\Brand\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Brand extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('brand', 'brand_id');
    }
}