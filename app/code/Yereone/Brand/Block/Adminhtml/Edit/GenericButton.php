<?php
namespace Yereone\Brand\Block\Adminhtml\Edit;

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

    public function getBrandId()
    {
        $brandId = $this->request->getParam('brand_id');
        return $brandId;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}