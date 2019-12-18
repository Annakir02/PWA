<?php
namespace Yereone\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Yereone\Slider\Model\Slide;
use Yereone\Slider\Model\SlideFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $slideFactory;
    protected $data;
    const ADMIN_RESOURCE = 'Yereone_Slider::save';

    public function __construct(
        Action\Context $context,
        SlideFactory $slideFactory
    ) {
        $this->slideFactory = $slideFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (empty($data['slide_id'])) {
            $data['slide_id'] = null;
        }

        $id = $this->getRequest()->getParam('slide_id');
        $slide = $this->slideFactory->create();
        if ($id) {
            $slide->load($id);
        }

        $slide->setData($data);

        try {
            $slide->save();
            $this->messageManager->addSuccessMessage(__('You saved the slide.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the slide.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['slide_id' => $id]);
    }
}
