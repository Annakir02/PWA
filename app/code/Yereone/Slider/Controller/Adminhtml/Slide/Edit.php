<?php
namespace Yereone\Slider\Controller\Adminhtml\Slide;

class Edit extends \Magento\Backend\App\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create('page');
        $resultPage->getConfig()->getTitle()->prepend(__('Slide'));
        return $resultPage;
    }
}
