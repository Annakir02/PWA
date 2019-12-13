<?php
namespace Yereone\Banner\Controller\Adminhtml\Banner;

use Magento\Backend\App\AbstractAction;

class Index extends AbstractAction
{
    public function execute()
    {
        $result = $this->resultFactory->create('page');
        $result->getConfig()->getTitle()->prepend(__('Banners'));
        return $result;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Yereone_Banner::banners');
    }

}
