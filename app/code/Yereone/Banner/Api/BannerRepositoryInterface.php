<?php
namespace Yereone\Banner\Api;

interface BannerRepositoryInterface
{
    /**
     * @param int $bannerId
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($bannerId);
}
