<?php
namespace Yereone\Slider\Controller\Adminhtml\Slide;

class Delete  extends \Magento\Backend\App\AbstractAction
{
    const ADMIN_RESOURCE = 'Yereone_Slider::delete';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slide_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Yereone\Slider\Model\Slide::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the slide.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['slide_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a slide to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
