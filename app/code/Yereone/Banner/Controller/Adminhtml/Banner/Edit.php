<?php
namespace Yereone\Banner\Controller\Adminhtml\Banner;

class Edit extends \Magento\Backend\App\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create('page');
        $resultPage->getConfig()->getTitle()->prepend(__('Banners'));
        return $resultPage;
    }
}
