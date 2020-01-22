<?php
namespace Yereone\Slider\Api;

interface SlideRepositoryInterface
{
    /**
     * @param int $slideId
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($slideId);
}