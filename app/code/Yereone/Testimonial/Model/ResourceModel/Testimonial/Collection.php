<?php
namespace Yereone\Testimonial\Model\ResourceModel\Testimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yereone\Testimonial\Model\Testimonial::class,
            \Yereone\Testimonial\Model\ResourceModel\Testimonial::class
        );
    }
}