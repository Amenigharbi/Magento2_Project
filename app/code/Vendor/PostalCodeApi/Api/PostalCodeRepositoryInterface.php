<?php
namespace Vendor\PostalCodeApi\Api;

use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface PostalCodeRepositoryInterface
{
    /**
     * Save postal code.
     *
     * @param array $postalCodeData
     * @return array $postalCodeData
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(array $postalCodeData);

    /**
     * Get postal code by ID.
     *
     * @param int $id
     * @return \Vendor\PostalCodeApi\Api\Data\PostalCodeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

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
}
