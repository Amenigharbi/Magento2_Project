<?php

namespace Vendor\Check\Model\ResourceModel\CityPostalCode;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollectionFactory;

class CollectionFactory
{
    protected $collectionFactory;

    public function __construct(
        AbstractCollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function create()
    {
        return $this->collectionFactory->create();
    }
}
