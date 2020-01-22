<?php
namespace Yereone\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Yereone\Brand\Model\BrandFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Yereone\Brand\Model\ImageUploader;
use Yereone\Brand\Api\BrandRepositoryInterface;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $brandFactory;
    protected $data;
    protected $dataPersistor;
    private $imageUploader;
    private $brandRepository;
    const ADMIN_RESOURCE = 'Yereone_Brand::save';

    public function __construct(
        Action\Context $context,
        BrandFactory $brandFactory,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->brandFactory = $brandFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->brandRepository = $brandRepository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('brand_id');
        $brand = $this->brandFactory->create();
        if (empty($data['brand_id'])) {
            $data['brand_id'] = null;
        }

        if ($id) {
            $brand->load($id);
        }

        if($data['image'][0]['name'] != $brand->getImage()) {
            $fileName = $data['image'][0]['name'];
            $data['image'] = $fileName;
            $this->imageUploader->moveFileFromTmp($fileName);

        } else {
            $data['image'] = $data['image'][0]['name'];
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

        return $resultRedirect->setPath('*/*/edit', ['brand_id' => $brand->getId()]);
    }
}
