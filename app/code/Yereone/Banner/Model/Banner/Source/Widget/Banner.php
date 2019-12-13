<?php
namespace Yereone\Banner\Model\Banner\Source\Widget;

use \Magento\Framework\Option\ArrayInterface;

class Banner implements ArrayInterface
{
    private $bannerFactory;

    function __construct(\Yereone\Banner\Model\BannerFactory $bannerFactory)
    {
        $this->bannerFactory = $bannerFactory;
    }

    public function toOptionArray()
    {
        $banner = $this->bannerFactory->create();
        $banners = $banner->getCollection();
        $return = [];

        foreach ($banners as $banner) {
            array_push($return, ['value' => $banner->getId(), 'label' => $banner->getTitle()]);
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
