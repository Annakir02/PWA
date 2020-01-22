<?php
namespace Yereone\Testimonial\Block;

use Magento\Framework\View\Element\Template;

class Testimonials extends Template
{
    protected $_scopeConfig;
    protected $testimonialFactory;
    public $_storeManager;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Yereone\Testimonial\Model\TestimonialFactory $testimonialFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $data);
        $this->testimonialFactory = $testimonialFactory;
        $this->_storeManager = $storeManager;
    }

    public function getTestimonials()
    {
        $testimonial = $this->testimonialFactory->create();
        $testimonials = $testimonial->getCollection();

        return $testimonials;
    }

    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
