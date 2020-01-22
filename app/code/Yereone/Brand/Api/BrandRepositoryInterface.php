<?php

namespace Yereone\Brand\Api;

interface BrandRepositoryInterface
{
    /**
     * @param int $brandId
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($brandId);
}
