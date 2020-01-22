<?php
namespace Yereone\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Yereone\Testimonial\Model\TestimonialFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Yereone\Testimonial\Model\ImageUploader;
use Yereone\Testimonial\Api\TestimonialRepositoryInterface;


class Save extends \Magento\Backend\App\AbstractAction
{
    protected $testimonialFactory;
    protected $data;
    protected $dataPersistor;
    private $imageUploader;
    const ADMIN_RESOURCE = 'Yereone_Testimonial::save';
    private $testimonialRepository;

    public function __construct(
        Action\Context $context,
        TestimonialFactory $testimonialFactory,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        TestimonialRepositoryInterface $testimonialRepository
    ) {
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->testimonialRepository = $testimonialRepository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('testimonial_id');
        $testimonial = $this->testimonialFactory->create();

        if (empty($data['testimonial_id'])) {
            $data['testimonial_id'] = null;
        }

        if ($id) {
            $testimonial->load($id);
        }

        if($data['image'][0]['name'] != $testimonial->getImage()) {
            $fileName = $data['image'][0]['name'];
            $data['image'] = $fileName;
            $this->imageUploader->moveFileFromTmp($fileName);

        } else {
            $data['image'] = $data['image'][0]['name'];
        }

        $testimonial->setData($data);

        try {
            $testimonial->save();
            $this->messageManager->addSuccessMessage(__('You saved the testimonial.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the testimonial.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $testimonial->getId()]);
    }
}
