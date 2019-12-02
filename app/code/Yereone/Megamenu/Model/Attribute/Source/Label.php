<?php
namespace Yereone\Megamenu\Model\Attribute\Source;

use \Magento\Framework\Option\ArrayInterface;

class Label implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => 'Select'],
            ['value' => 'sale', 'label' =>'Sale'],
            ['value' => 'new', 'label' => 'New'],
        ];
    }

    public function toArray()
    {
        return ['' => 'Select', 'sale' => 'Sale', 'new' => 'New'];
    }
}
