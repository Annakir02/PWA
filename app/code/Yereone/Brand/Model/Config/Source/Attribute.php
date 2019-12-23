<?php
namespace Yereone\Brand\Model\Config\Source;

use \Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Magento\Eav\Model\Entity\TypeFactory;


class Attribute implements ArrayInterface
{
    protected $attributeFactory;
    protected $eavTypeFactory;

    function __construct(AttributeFactory $attributeFactory, TypeFactory $typeFactory)
    {
        $this->attributeFactory = $attributeFactory;
        $this->eavTypeFactory = $typeFactory;
    }

    public function toOptionArray()
    {
        $return = [];
        $entityType = $this->eavTypeFactory->create()->loadByCode('catalog_product');
        $collection = $this->attributeFactory->create()->getCollection();
        $collection->addFieldToFilter('entity_type_id', $entityType->getId());
        $collection->setOrder('attribute_code');

        foreach ($collection as $attribute) {
            array_push($return, ['value' => $attribute->getAttributeId(), 'label' => $attribute->getFrontendLabel()]);
        }

        return $return;
    }

    public function toArray()
    {
        $options = $this->toOptionArray();
        $return = [];

        foreach ($options as $option) {
            $return[$option['value']] = $option['label'];
        }

        return $return;
    }
}
