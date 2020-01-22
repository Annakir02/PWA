<?php
namespace Yereone\Slider\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Slider extends Template implements BlockInterface
{
    protected $slideFactory;
    protected $_template = "slider.phtml";
    public $_storeManager;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Yereone\Slider\Model\SlideFactory $slideFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $data);
        $this->slideFactory = $slideFactory;
        $this->_storeManager = $storeManager;
    }

    public function getSlides()
    {
        $slide = $this->slideFactory->create();
        $slideCollection = $slide->getCollection()
                ->addFieldToFilter('slider_id', $this->getSliderId()
        );
        return $slideCollection;
    }
    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
