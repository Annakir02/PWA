<?php
namespace Yereone\Brand\Model;

use Yereone\Brand\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Yereone\Brand\Api\BrandRepositoryInterface;
use Yereone\Brand\Model\Brand\FileInfo;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $request;
    protected $fileInfo;
    protected $brandRepository;
    const ADMIN_RESOURCE = 'Yereone_Brand::save';

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\App\Request\Http $request,
        BrandRepositoryInterface $brandRepository,
        FileInfo $fileInfo,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->brandRepository = $brandRepository;
        $this->request = $request;
        $this->fileInfo = $fileInfo;
        $this->collection = $blockCollectionFactory->create();
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

        $brandId = $this->request->getParam('brand_id');

        if($brandId) {
            $item = $this->brandRepository->getById($brandId);
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

        $data = $this->dataPersistor->get('brand');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('brand');
        }

        return $this->loadedData;
    }

}
