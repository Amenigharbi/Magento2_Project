<?php

namespace Vendor\Check\Model;

use Vendor\Check\Model\ResourceModel\CityPostalCode\CollectionFactory;

class CityPostalCodeRepository
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getPostalCodesByRegionId($regionId)
    {
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('region_id', $regionId);

        $postalCodes = [];
        foreach ($collection as $postalCode) {
            $postalCodes[] = ['value' => $postalCode->getPostalCode(), 'label' => $postalCode->getPostalCode()];
        }

        return $postalCodes;
    }
}
