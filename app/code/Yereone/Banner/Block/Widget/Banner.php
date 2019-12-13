<?php
namespace Yereone\Banner\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $bannerFactory;
    protected $_template = "banner.phtml";

    public function __construct(Template\Context $context, array $data = [],\Yereone\Banner\Model\BannerFactory $bannerFactory)
    {
        parent::__construct($context, $data);
        $this->bannerFactory = $bannerFactory;
    }

    public function getBanner()
    {
        $banner = $this->bannerFactory->create();
        return $banner->load($this->getBannerId());
    }
}
