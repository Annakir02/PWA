<?php
namespace Yereone\Testimonial\Model\Testimonial\Source;

use \Magento\Framework\Option\ArrayInterface;

class TestimonialRatingStars implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
                ['value' => '1', 'label' => __('One Star')],
                ['value' => '2', 'label' => __('Two Stars')],
                ['value' => '3', 'label' => __('Three Stars')],
                ['value' => '4', 'label' => __('Four Stars')],
                ['value' => '5', 'label' => __('Fife Stars')],
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
