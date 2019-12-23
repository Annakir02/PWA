<?php
namespace Yereone\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Yereone\Brand\Model\BrandFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $brandFactory;
    protected $data;
    const ADMIN_RESOURCE = 'Yereone_Brand::save';

    public function __construct(
        Action\Context $context,
        BrandFactory $brandFactory
    ) {
        $this->brandFactory = $brandFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (empty($data['brand_id'])) {
            $data['brand_id'] = null;
        }

        $id = $this->getRequest()->getParam('brand_id');
        $brand = $this->brandFactory->create();
        if ($id) {
            $brand->load($id);
        }

        $brand->setData($data);

        try {
            $brand->save();
            $this->messageManager->addSuccessMessage(__('You saved the brand.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the brand.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['brand_id' => $id]);
    }
}
