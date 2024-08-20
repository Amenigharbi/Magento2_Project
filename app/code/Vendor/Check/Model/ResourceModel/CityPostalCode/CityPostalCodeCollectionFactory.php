<?php

namespace Vendor\Check\Model\ResourceModel\CityPostalCode;

use Magento\Framework\Data\Collection\EntityFactoryInterface;

class CityPostalCodeCollectionFactory 
{
    protected $entityFactory;

    public function __construct(EntityFactoryInterface $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    /**
     * Create and return a new instance of CityPostalCode Collection
     *
     * @return Collection
     */
    public function create()
    {
        return new Collection($this->entityFactory);
    }
}
