<?php
namespace Vendor\PostalCodeApi\Api\Data;

interface PostalCodeInterface
{
    const ENTITY_ID = 'entity_id';
    const POSTAL_CODE = 'postal_code';
    const REGION_ID = 'region_id'; // Assurez-vous que REGION_ID est défini si nécessaire

    public function getId();

    public function getPostalCode();

    public function getRegionId();

    public function setId($id);

    public function setPostalCode($postalCode);

    public function setRegionId($regionId);
}
