<?php
namespace Yereone\Banner\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Yereone\Banner\Model\BannerFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $bannerFactory;
    protected $data;
    const ADMIN_RESOURCE = 'Yereone_Banner::save';

    public function __construct(
        Action\Context $context,
        BannerFactory $bannerFactory
    ) {
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (empty($data['banner_id'])) {
            $data['banner_id'] = null;
        }

        $id = $this->getRequest()->getParam('banner_id');
        $banner = $this->bannerFactory->create();
        if ($id) {
            $banner->load($id);
        }

        $banner->setData($data);

        try {
            $banner->save();
            $this->messageManager->addSuccessMessage(__('You saved the banner.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the banner.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['slider_id' => $id]);
    }
}
