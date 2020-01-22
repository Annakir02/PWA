<?php
namespace Yereone\Banner\Model;

use Yereone\Banner\Api\Data;
use Yereone\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class BannerRepository implements BannerRepositoryInterface
{
    protected $bannerFactory;

    public function __construct(BannerFactory $bannerFactory)
    {
       $this->bannerFactory = $bannerFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($bannerId)
    {
        $banner = $this->bannerFactory->create();
        $banner->load($bannerId);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(__('The Banner with the "%1" ID doesn\'t exist.', $bannerId));
        }
        return $banner;
    }
}
