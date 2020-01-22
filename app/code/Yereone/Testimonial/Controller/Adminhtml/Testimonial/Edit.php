<?php
namespace Yereone\Testimonial\Controller\Adminhtml\Testimonial;

class Edit extends \Magento\Backend\App\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create('page');
        $resultPage->getConfig()->getTitle()->prepend(__('Testimonials'));
        return $resultPage;
    }
}
