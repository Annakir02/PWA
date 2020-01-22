<?php
namespace Yereone\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Yereone\Slider\Model\SlideFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Yereone\Slider\Model\ImageUploader;
use Yereone\Slider\Api\SlideRepositoryInterface;

class Save extends \Magento\Backend\App\AbstractAction
{
    protected $slideFactory;
    protected $data;
    protected $dataPersistor;
    private $imageUploader;
    private $slideRepository;
    const ADMIN_RESOURCE = 'Yereone_Slide::save';

    public function __construct(
        Action\Context $context,
        SlideFactory $slideFactory,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        SlideRepositoryInterface $slideRepository
    ) {
        $this->slideFactory = $slideFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->slideRepository = $slideRepository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('slide_id');
        $slide = $this->slideFactory->create();
        if (empty($data['slide_id'])) {
            $data['slide_id'] = null;
        }

        if ($id) {
            $slide->load($id);
        }

        if($data['image'][0]['name'] != $slide->getImage()) {
            $fileName = $data['image'][0]['name'];
            $data['image'] = $fileName;
            $this->imageUploader->moveFileFromTmp($fileName);

        } else {
            $data['image'] = $data['image'][0]['name'];
        }

        $slide->setData($data);

        try {
            $slide->save();
            $this->messageManager->addSuccessMessage(__('You saved the slide.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the slide.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['slide_id' => $slide->getId()]);
    }
}
