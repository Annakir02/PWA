<?php
namespace Yereone\Slider\Model\Slider\Source\Widget;

use \Magento\Framework\Option\ArrayInterface;

class Slider implements ArrayInterface
{
    private $sliderFactory;

    function __construct(\Yereone\Slider\Model\SliderFactory $sliderFactory)
    {
        $this->sliderFactory = $sliderFactory;
    }

    public function toOptionArray()
    {
        $slider = $this->sliderFactory->create();
        $sliders = $slider->getCollection();
        $return = [];

        foreach ($sliders as $slider) {
            array_push($return, ['value' => $slider->getId(), 'label' => $slider->getName()]);
        }

        return $return;
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
