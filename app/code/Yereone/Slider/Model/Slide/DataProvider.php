<?php
namespace Yereone\Slider\Model\Slide;

use Yereone\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Yereone\Slider\Api\SlideRepositoryInterface;
use Yereone\Slider\Model\Slide\FileInfo;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $request;
    protected $fileInfo;
    protected $slideRepository;
    const ADMIN_RESOURCE = 'Yereone_slide::save';

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\App\Request\Http $request,
        SlideRepositoryInterface $slideRepository,
        FileInfo $fileInfo,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->slideRepository = $slideRepository;
        $this->request = $request;
        $this->fileInfo = $fileInfo;
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }

        $slideId = $this->request->getParam('slide_id');

        if($slideId) {
            $item = $this->slideRepository->getById($slideId);
            $fileName = $item->getData('image');

            if($this->fileInfo->isExist($fileName) && $fileName !== '') {
                $stat = $this->fileInfo->getStat($fileName);
                $image = [
                        0 => [
                                'name' =>  basename($fileName),
                                'url' => $this->fileInfo->getAbsolutePatch($fileName),
                                'size' => isset($stat) ? $stat['size'] : 0,
                                'type' => $this->fileInfo->getMimeType($fileName)
                        ]
                ];

                $item->setData('image', $image);

            }

            $this->loadedData[$item->getId()] = $item->getData();
        }

        $data = $this->dataPersistor->get('slide');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('slide');
        }

        return $this->loadedData;
    }

}
