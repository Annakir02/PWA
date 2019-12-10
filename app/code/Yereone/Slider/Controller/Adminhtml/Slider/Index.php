<?php
namespace Yereone\Slider\Controller\Adminhtml\Slider;

use Magento\Backend\App\AbstractAction;

class Index extends AbstractAction
{
    public function execute()
    {
        $result = $this->resultFactory->create('page');
        $result->getConfig()->getTitle()->prepend(__('Sliders'));
        return $result;
    }
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Yereone_Slider::sliders');
	}

}
