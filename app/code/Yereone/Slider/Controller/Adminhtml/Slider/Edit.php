<?php
namespace Yereone\Slider\Controller\Adminhtml\Slider;

class Edit extends \Magento\Backend\App\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create('page');
        $resultPage->getConfig()->getTitle()->prepend(__('Sliders'));
        return $resultPage;
    }
}
