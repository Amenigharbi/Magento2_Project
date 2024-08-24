<?php
namespace Vendor\PostalCodeApi\Api\Data;

/**
 * Interface PostalCodeInterface
 * @package Vendor\PostalCodeApi\Api\Data
 */
interface PostalCodeInterface
{
    /**#@+
     * Constants for field names
     */
    const ENTITY_ID = 'entity_id';
    const POSTAL_CODE = 'postal_code';
    const REGION_ID = 'region_id';
    /**#@-*/

    /**
     * Get entity ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get postal code
     *
     * @return string|null
     */
    public function getPostalCode();

    /**
     * Get region ID
     *
     * @return int|null
     */
    public function getRegionId();

    /**
     * Set entity ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode($postalCode);

    /**
     * Set region ID
     *
     * @param int $regionId
     * @return $this
     */
    public function setRegionId($regionId);
}
