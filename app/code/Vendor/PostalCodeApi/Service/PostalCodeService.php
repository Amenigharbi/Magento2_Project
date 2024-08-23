<?php
namespace Vendor\PostalCodeApi\Service;

use Vendor\PostalCodeApi\Model\PostalCode;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;

class PostalCodeService
{
    protected $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function save(PostalCode $postalCode)
    {
        $connection = $this->resource->getConnection();
        $data = [
            'postal_code' => $postalCode->getPostalCode(),
            'region_id' => $postalCode->getRegionId()
        ];

        try {
            if ($postalCode->getId()) {
                // Update existing record
                $where = ['entity_id = ?' => $postalCode->getId()];
                $connection->update($this->resource->getTableName('directory_city_postal_codes'), $data, $where);
            } else {
                // Insert new record
                $connection->insert($this->resource->getTableName('directory_city_postal_codes'), $data);
                $postalCode->setId($connection->lastInsertId());
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return $postalCode;
    }
}
