<?php
namespace Yereone\Brand\Controller\Adminhtml\Brand;

class Edit extends \Magento\Backend\App\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create('page');
        $resultPage->getConfig()->getTitle()->prepend(__('Brands'));
        return $resultPage;
    }
}
