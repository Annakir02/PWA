<?php
namespace Yereone\Banner\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Yereone\Banner\Model\BannerFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Yereone\Banner\Model\ImageUploader;
use Yereone\Banner\Api\BannerRepositoryInterface;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $bannerFactory;
    protected $data;
    protected $dataPersistor;
    private $imageUploader;
    private $bannerRepository;
    const ADMIN_RESOURCE = 'Yereone_Banner::save';

    public function __construct(
        Action\Context $context,
        BannerFactory $bannerFactory,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        BannerRepositoryInterface $bannerRepository
    ) {
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->bannerRepository = $bannerRepository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('banner_id');
        $banner = $this->bannerFactory->create();
        if (empty($data['banner_id'])) {
            $data['banner_id'] = null;
        }

        if ($id) {
            $banner->load($id);
        }

        if($data['image'][0]['name'] != $banner->getImage()) {
            $fileName = $data['image'][0]['name'];
            $data['image'] = $fileName;
            $this->imageUploader->moveFileFromTmp($fileName);

        } else {
            $data['image'] = $data['image'][0]['name'];
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

        return $resultRedirect->setPath('*/*/edit', ['banner_id' =>  $banner->getId()]);
    }
}
