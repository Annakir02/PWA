<?php
namespace Yereone\Banner\Controller\Adminhtml\Banner;

class Delete  extends \Magento\Backend\App\AbstractAction
{
    const ADMIN_RESOURCE = 'Yereone_Banner::delete';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('banner_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Yereone\Banner\Model\Banner::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the banner.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['banner_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a banner to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
