<?php
namespace Vendor\PostalCodeApi\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\PostalCodeApi\Api\Data\PostalCodeInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PostalCode extends AbstractModel implements PostalCodeInterface
{
    protected function _construct()
    {
        $this->_init('Vendor\PostalCodeApi\Model\ResourceModel\PostalCode');
    }

    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getPostalCode()
    {
        return $this->getData(self::POSTAL_CODE);
    }

    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function setPostalCode($postalCode)
    {
        return $this->setData(self::POSTAL_CODE, $postalCode);
    }
    public function getRegionId()
    {
        return $this->_getData(self::REGION_ID);
    }

    public function setRegionId($regionId)
    {
        return $this->setData(self::REGION_ID, $regionId);
    }

}
