<?php
namespace Yereone\Slider\Block;

use Magento\Framework\View\Element\Template;

class Slider extends Template
{
    protected $sliderFactory;
    protected $slideFactory;

    public function __construct(Template\Context $context, array $data = [],\Yereone\Slider\Model\SliderFactory $sliderFactory,\Yereone\Slider\Model\SlideFactory $slideFactory)
    {
        parent::__construct($context, $data);
        $this->slideFactory = $slideFactory;
        $this->sliderFactory = $sliderFactory;
    }

    public function getSlides() {

        $slide = $this->slideFactory->create();
        $slideCollection = $slide->getCollection()->addFieldToFilter('slider_id',array('eq' => $this->getData('slider_id')));
        return $slideCollection;
    }
}
