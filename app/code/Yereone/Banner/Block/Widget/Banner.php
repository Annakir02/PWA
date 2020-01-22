<?php
namespace Yereone\Banner\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $bannerFactory;
    protected $_template = "banner.phtml";
    public $_storeManager;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Yereone\Banner\Model\BannerFactory $bannerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $data);
        $this->bannerFactory = $bannerFactory;
        $this->_storeManager = $storeManager;
    }

    public function getBanner()
    {
        $banner = $this->bannerFactory->create();
        return $banner->load($this->getBannerId());
    }

    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
