<?php
namespace Yereone\Testimonial\Api;

interface TestimonialRepositoryInterface
{
    /**
     * @param int $testimonialId
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($testimonialId);
}
