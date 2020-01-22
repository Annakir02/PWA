<?php
namespace Yereone\Slider\Model\Slide;

use Yereone\Slider\Api\Data;
use Yereone\Slider\Api\SlideRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SlideRepository implements SlideRepositoryInterface
{
    protected $slideFactory;

    public function __construct(\Yereone\Slider\Model\SlideFactory $slideFactory)
    {
       $this->slideFactory = $slideFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($slideId)
    {
        $slide = $this->slideFactory->create();
        $slide->load($slideId);
        if (!$slide->getId()) {
            throw new NoSuchEntityException(__('The Slide with the "%1" ID doesn\'t exist.', $slideId));
        }
        return $slide;
    }
}
