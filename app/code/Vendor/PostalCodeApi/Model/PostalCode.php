<?php
namespace Vendor\PostalCodeApi\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Vendor\PostalCodeApi\Model\ResourceModel\PostalCode as PostalCodeResource;

/**
 * Class PostalCode
 * @package Vendor\PostalCodeApi\Model
 */
class PostalCode extends AbstractModel implements PostalCodeInterface
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(PostalCodeResource::class);
    }

    /**
     * Get entity ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Get postal code
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->getData(self::POSTAL_CODE);
    }

    /**
     * Set entity ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        return $this->setData(self::POSTAL_CODE, $postalCode);
    }

    /**
     * Get region ID
     *
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->getData(self::REGION_ID);
    }

    /**
     * Set region ID
     *
     * @param int $regionId
     * @return $this
     */
    public function setRegionId($regionId)
    {
        return $this->setData(self::REGION_ID, $regionId);
    }
}
