<?php

namespace Yereone\Banner\Model\Banner\Source;

use \Magento\Framework\Option\ArrayInterface;

class BannerTextPosition implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'b_top_left', 'label' => __('Top Left')],
            ['value' => 'b_top_center', 'label' => __('Top Center')],
            ['value' => 'b_top_right', 'label' => __('Top Right')],
            ['value' => 'b_middle_left', 'label' => __('Middle Left')],
            ['value' => 'b_middle_center', 'label' => __('Middle Center')],
            ['value' => 'b_middle_right', 'label' => __('Middle Right')],
            ['value' => 'b_bottom_left', 'label' => __('Bottom Left')],
            ['value' => 'b_bottom_center', 'label' => __('Bottom Center')],
            ['value' => 'b_bottom_right', 'label' => __('Bottom Right')]
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
