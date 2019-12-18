<?php

namespace Yereone\Slider\Model\Slider\Source;

use \Magento\Framework\Option\ArrayInterface;

class SliderTextPosition implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 's_top_left', 'label' => __('Top Left')],
            ['value' => 's_top_center', 'label' => __('Top Center')],
            ['value' => 's_top_right', 'label' => __('Top Right')],
            ['value' => 's_middle_left', 'label' => __('Middle Left')],
            ['value' => 's_middle_center', 'label' => __('Middle Center')],
            ['value' => 's_middle_right', 'label' => __('Middle Right')],
            ['value' => 's_bottom_left', 'label' => __('Bottom Left')],
            ['value' => 's_bottom_center', 'label' => __('Bottom Center')],
            ['value' => 's_bottom_right', 'label' => __('Bottom Right')]
        ];
    }

    public function toArray()
    {
        $options = $this->toOptionArray();
        $return = [];

        foreach ($options as $option) {
            $return[$option['value']] = $option['label'];
        }

        return $return;
    }
}
