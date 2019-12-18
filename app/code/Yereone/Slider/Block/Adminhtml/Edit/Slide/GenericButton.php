<?php
namespace Yereone\Slider\Block\Adminhtml\Edit\Slide;

use Magento\Framework\App\RequestInterface;

class GenericButton
{
    protected $urlBuilder;
    protected $request;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        RequestInterface $request
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $request;

    }

    public function getSlideId()
    {
        $sliderId = $this->request->getParam('slide_id');
        return $sliderId;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}