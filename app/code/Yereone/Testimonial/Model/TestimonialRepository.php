<?php
namespace Yereone\Testimonial\Model;

use Yereone\Testimonial\Api\Data;
use Yereone\Testimonial\Api\TestimonialRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    protected $testimonialFactory;

    public function __construct(TestimonialFactory $testimonialFactory)
    {
       $this->testimonialFactory = $testimonialFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($testimonialId)
    {
        $testimonial = $this->testimonialFactory->create();
        $testimonial->load($testimonialId);
        if (!$testimonial->getId()) {
            throw new NoSuchEntityException(__('The Testimonial with the "%1" ID doesn\'t exist.', $testimonialId));
        }
        return $testimonial;
    }
}
