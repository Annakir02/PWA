<?php
namespace Yereone\Slider\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action;
use Yereone\Slider\Model\Slider;
use Yereone\Slider\Model\SliderFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $sliderFactory;
    protected $data;
    const ADMIN_RESOURCE = 'Yereone_Slider::save';

    public function __construct(
        Action\Context $context,
        SliderFactory $sliderFactory
    ) {
        $this->sliderFactory = $sliderFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (empty($data['slider_id'])) {
            $data['slider_id'] = null;
        }

        $id = $this->getRequest()->getParam('slider_id');
        $slider = $this->sliderFactory->create();
        if ($id) {
            $slider->load($id);
        }

        $slider->setData($data);

        try {
            $slider->save();
            $this->messageManager->addSuccessMessage(__('You saved the slider.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the slider.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['slider_id' => $slider->getId()]);
    }
}
