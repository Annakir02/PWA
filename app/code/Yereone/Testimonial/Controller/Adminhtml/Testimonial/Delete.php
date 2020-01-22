<?php
namespace Yereone\Testimonial\Controller\Adminhtml\Testimonial;

class Delete  extends \Magento\Backend\App\AbstractAction
{
    const ADMIN_RESOURCE = 'Yereone_Testimonial::delete';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('testimonial_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Yereone\Testimonial\Model\Testimonial::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the testimonial.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a testimonial to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
