<?php
namespace Yereone\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\AbstractAction;

class Index extends AbstractAction
{
    public function execute()
    {
        $result = $this->resultFactory->create('page');
        $result->getConfig()->getTitle()->prepend(__('Brands'));
        return $result;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Yereone_Brand::brands');
    }

}
