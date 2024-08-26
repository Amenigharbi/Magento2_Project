<?php
namespace Vendor\PostalCodeApi\Model;

use Vendor\PostalCodeApi\Api\PostalCodeRepositoryInterface;
use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\App\ResourceConnection;
use Vendor\PostalCodeApi\Model\ResourceModel\PostalCode as PostalCodeResource;

/**
 * Class PostalCodeRepository
 * @package Vendor\PostalCodeApi\Model
 */
class PostalCodeRepository implements PostalCodeRepositoryInterface
{
    /**
     * @var \Vendor\PostalCodeApi\Model\PostalCodeFactory
     */
    protected $postalCodeFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var ResourceConnection
     */
    protected $resource;

    /**
     * @var PostalCodeResource
     */
    protected $postalCodeResource;

    /**
     * PostalCodeRepository constructor.
     *
     * @param \Vendor\PostalCodeApi\Model\PostalCodeFactory $postalCodeFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param ResourceConnection $resource
     * @param PostalCodeResource $postalCodeResource
     */
    public function __construct(
        \Vendor\PostalCodeApi\Model\PostalCodeFactory $postalCodeFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        ResourceConnection $resource,
        PostalCodeResource $postalCodeResource
    ) {
        $this->postalCodeFactory = $postalCodeFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->resource = $resource;
        $this->postalCodeResource = $postalCodeResource;
    }

    /**
     * Get database connection.
     *
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected function getConnection()
    {
        return $this->resource->getConnection();
    }

    /**
     * Save a postal code.
     *
     * @param PostalCodeInterface $postalCode
     * @return PostalCodeInterface
     * @throws LocalizedException
     */
    public function save(PostalCodeInterface $postalCode)
    {
        $this->postalCodeResource->save($postalCode);
        return $postalCode;
    }

    /**
     * Create and save a postal code from data.
     *
     * @param string $data JSON encoded postal code data
     * @return PostalCodeInterface
     * @throws LocalizedException
     */
    public function createPostalCode($data)
    {
        // Decode JSON if necessary
        $data = json_decode($data, true);
    
        if (empty($data['postal_code']) || empty($data['region_id'])) {
            throw new LocalizedException(__('Postal code and region ID are required.'));
        }
    
        // Check if postal code already exists
        $connection = $this->getConnection();
        $tableName = $this->resource->getTableName('directory_city_postal_codes');
        
        $select = $connection->select()
            ->from($tableName, ['entity_id'])
            ->where('postal_code = ?', $data['postal_code'])
            ->where('region_id = ?', $data['region_id']);
        
        $existingPostalCode = $connection->fetchOne($select);
        
        if ($existingPostalCode) {
            throw new LocalizedException(__('Postal code already exists in the specified region.'));
        }
    
        /** @var PostalCodeInterface $postalCode */
        $postalCode = $this->postalCodeFactory->create();
        $postalCode->setData($data);
        return $this->save($postalCode);
    }
    

    /**
     * Retrieve a postal code by its ID.
     *
     * @param int $id
     * @return PostalCodeInterface
     * @throws NoSuchEntityException
     */
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

        /** @var PostalCodeInterface $postalCode */
        $postalCode = $this->postalCodeFactory->create();
        $postalCode->setData($result);

        return $postalCode;
    }

    /**
     * Retrieve postal codes by region ID.
     *
     * @param int $regionId
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
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

    /**
     * Retrieve a list of all postal codes.
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
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

    /**
     * Delete a postal code by its ID.
     *
     * @param int $id
     * @return string
     */
    public function deleteById($id)
    {
    $connection = $this->getConnection();
    $tableName = $this->resource->getTableName('directory_city_postal_codes');

    // Fetch the postal code before deletion
    $select = $connection->select()
        ->from($tableName, ['postal_code'])
        ->where('entity_id = ?', $id);
    $postalCode = $connection->fetchOne($select);

    if ($postalCode) {
        // Proceed to delete
        $where = ['entity_id = ?' => $id];
        $result = $connection->delete($tableName, $where);

        if ($result > 0) {
            return "Postal code '{$postalCode}' with ID '{$id}' deleted successfully.";
        }
    }

    return "Error: Postal code with ID '{$id}' could not be found or deleted.";
     }

    /**
     * Delete postal codes by region ID.
     *
     * @param int $regionId
     * @return string  
     */
    public function deleteByRegionId($regionId)
    {
        $connection = $this->getConnection();
        $tableName = $this->resource->getTableName('directory_city_postal_codes');
    
        // Fetch the postal codes before deletion
        $select = $connection->select()
            ->from($tableName, ['postal_code'])
            ->where('region_id = ?', $regionId);
        $postalCodes = $connection->fetchCol($select);
    
        if ($postalCodes) {
            // Proceed to delete
            $where = ['region_id = ?' => $regionId];
            $result = $connection->delete($tableName, $where);
    
            if ($result > 0) {
                $postalCodesList = implode(', ', $postalCodes);
                return "Postal codes '{$postalCodesList}' for region ID '{$regionId}' deleted successfully.";
            }
        }
    
        return "Error: Postal codes for region ID '{$regionId}' could not be found or deleted.";
    }


    /**
     * Update a postal code by ID.
     *
     * @param int $id The ID of the postal code to update.
     * @param string $data JSON string with postal code data.
     * @return string 
     * @throws \Magento\Framework\Exception\NoSuchEntityException If the postal code with the given ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException If an error occurs during the update process.
     */
    public function updatePostalCode($id, $data)
    {
        $postalCode = $this->postalCodeFactory->create();
        $this->postalCodeResource->load($postalCode, $id);
    
        if (!$postalCode->getId()) {
            throw new NoSuchEntityException(__('Postal code with ID "%1" does not exist.', $id));
        }
    
        try {
            // Decode JSON data into an array
            $postalCodeData = json_decode($data, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new LocalizedException(__('Invalid JSON data.'));
            }
    
            // Check if postal code already exists
            $connection = $this->getConnection();
            $tableName = $this->resource->getTableName('directory_city_postal_codes');
            
            $select = $connection->select()
                ->from($tableName, ['entity_id'])
                ->where('postal_code = ?', $postalCodeData['postal_code'])
                ->where('region_id = ?', $postalCodeData['region_id'])
                ->where('entity_id <> ?', $id); // Exclude current ID
            
            $existingPostalCode = $connection->fetchOne($select);
            
            if ($existingPostalCode) {
                throw new LocalizedException(__('Postal code already exists in the specified region.'));
            }
    
            // Update postal code data
            $postalCode->addData($postalCodeData);
    
            // Save the updated postal code using PostalCodeResource
            $this->postalCodeResource->save($postalCode);
    
            // Return a success message as a plain string
            return 'Postal code with ID ' . $id . ' updated successfully.';
    
        } catch (\Exception $e) {
            throw new LocalizedException(__('Could not update postal code: %1', $e->getMessage()));
        }
    }
    
}
