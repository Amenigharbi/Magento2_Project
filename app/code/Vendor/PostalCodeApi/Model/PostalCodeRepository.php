<?php
namespace Vendor\PostalCodeApi\Model;

use Vendor\PostalCodeApi\Api\PostalCodeRepositoryInterface;
use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\App\ResourceConnection;

class PostalCodeRepository implements PostalCodeRepositoryInterface
{
    protected $postalCodeFactory;
    protected $searchResultsFactory;
    protected $resource;

    public function __construct(
        \Vendor\PostalCodeApi\Model\PostalCodeFactory $postalCodeFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        ResourceConnection $resource
    ) {
        $this->postalCodeFactory = $postalCodeFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->resource = $resource;
    }

    protected function getConnection()
    {
        return $this->resource->getConnection();
    }

    public function save(array $postalCodeData)
    {
        // Assurez-vous que postal_code et region_id ne sont pas nuls
        if (empty($postalCodeData['postal_code']) || empty($postalCodeData['region_id'])) {
            throw new LocalizedException(__('Postal Code and Region ID cannot be empty.'));
        }
    
        $connection = $this->getConnection();
        try {
            if (isset($postalCodeData['id']) && !empty($postalCodeData['id'])) {
                // Update existing record
                $where = ['entity_id = ?' => $postalCodeData['id']];
                $connection->update($this->resource->getTableName('directory_city_postal_codes'), $postalCodeData, $where);
            } else {
                // Insert new record
                $connection->insert($this->resource->getTableName('directory_city_postal_codes'), $postalCodeData);
                // Set the auto-incremented ID to the response
                $postalCodeData['id'] = $connection->lastInsertId();
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    
        return $postalCodeData;
    }
    


    public function getById($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->resource->getTableName('directory_city_postal_codes'))
            ->where('entity_id = ?', $id);

        $result = $connection->fetchRow($select);
        if (!$result) {
            throw new NoSuchEntityException(__('Postal Code with id "%1" does not exist.', $id));
        }

        return $this->postalCodeFactory->create()->setData($result);
    }

    public function getByRegionId($regionId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->resource->getTableName('directory_city_postal_codes'))
            ->where('region_id = ?', $regionId);

        $items = $connection->fetchAll($select);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setTotalCount(count($items));

        return $searchResults;
    }

    public function getList()
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->resource->getTableName('directory_city_postal_codes'));

        $items = $connection->fetchAll($select);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setTotalCount(count($items));

        return $searchResults;
    }

    public function deleteById($id)
    {
        $connection = $this->getConnection();
        $where = ['entity_id = ?' => $id];
        $result = $connection->delete($this->resource->getTableName('directory_city_postal_codes'), $where);

        return $result > 0;
    }

    public function deleteByRegionId($regionId)
    {
        $connection = $this->getConnection();
        $where = ['region_id = ?' => $regionId];
        $result = $connection->delete($this->resource->getTableName('directory_city_postal_codes'), $where);

        return $result > 0;
    }
}
