<?php
namespace Yereone\Brand\Controller\Adminhtml\Brand;

class Delete  extends \Magento\Backend\App\AbstractAction
{
    const ADMIN_RESOURCE = 'Yereone_Brand::delete';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('brand_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Yereone\Brand\Model\Brand::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the brand.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['brand_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a brand to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
