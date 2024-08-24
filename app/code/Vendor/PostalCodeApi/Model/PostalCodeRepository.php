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
     * @return bool
     */
    public function deleteById($id)
    {
        $connection = $this->getConnection();
        $where = ['entity_id = ?' => $id];
        $result = $connection->delete($this->resource->getTableName('directory_city_postal_codes'), $where);

        return $result > 0;
    }

    /**
     * Delete postal codes by region ID.
     *
     * @param int $regionId
     * @return bool
     */
    public function deleteByRegionId($regionId)
    {
        $connection = $this->getConnection();
        $where = ['region_id = ?' => $regionId];
        $result = $connection->delete($this->resource->getTableName('directory_city_postal_codes'), $where);

        return $result > 0;
    }
}
