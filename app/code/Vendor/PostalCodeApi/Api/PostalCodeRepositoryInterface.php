<?php
namespace Vendor\PostalCodeApi\Api;

use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface PostalCodeRepositoryInterface
{

    /**
     * Get postal code by ID.
     *
     * @param int $id
     * @return \Vendor\PostalCodeApi\Api\Data\PostalCodeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
    /**
    * Create a postal code.
    *
    * @param string $data JSON string with postal code data
    * @return \Vendor\PostalCodeApi\Api\Data\PostalCodeInterface
    * @throws \Magento\Framework\Exception\LocalizedException
    */
     public function createPostalCode($data);

    /**
     * Save postal code.
     *
     * @param PostalCodeInterface $postalCode
     * @return \Vendor\PostalCodeApi\Model\PostalCode
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostalCodeInterface $postalCode);
    /**
     * Get postal codes by region ID.
     *
     * @param int $regionId
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getByRegionId($regionId);

    /**
     * Get list of postal codes.
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList();

    /**
     * Delete postal code by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);

    /**
     * Delete postal codes by region ID.
     *
     * @param int $regionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteByRegionId($regionId);

   /**
     * Update a postal code by ID.
     *
     * @param int $id The ID of the postal code to update
     * @param string $data JSON string with postal code data
     * @return string 
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function updatePostalCode($id, $data);
}
