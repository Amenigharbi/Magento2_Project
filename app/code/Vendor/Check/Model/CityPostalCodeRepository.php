<?php

namespace Vendor\Check\Model;

use Vendor\Check\Model\ResourceModel\CityPostalCode\CityPostalCodeCollectionFactory; // Updated import

class CityPostalCodeRepository
{
    protected $collectionFactory;

    public function __construct(CityPostalCodeCollectionFactory $collectionFactory) // Updated dependency
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Retrieve postal codes by region ID
     *
     * @param int $regionId
     * @return array
     */
    public function getPostalCodesByRegionId($regionId)
    {
        // Create collection and apply region filter
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('region_id', $regionId);

        // Map the postal codes for the response
        $postalCodes = $collection->getColumnValues('postal_code');

        return array_map(function ($postalCode) {
            return ['value' => $postalCode, 'label' => $postalCode];
        }, $postalCodes);
    }
}
