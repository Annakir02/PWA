<?php
namespace Yereone\Brand\Model;

use Yereone\Brand\Api\Data;
use Yereone\Brand\Api\BrandRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class BrandRepository implements BrandRepositoryInterface
{
    protected $brandFactory;

    public function __construct(BrandFactory $brandFactory)
    {
       $this->brandFactory = $brandFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($brandId)
    {
        $brand = $this->brandFactory->create();
        $brand->load($brandId);
        if (!$brand->getId()) {
            throw new NoSuchEntityException(__('The Brand with the "%1" ID doesn\'t exist.', $brandId));
        }
        return $brand;
    }
}
