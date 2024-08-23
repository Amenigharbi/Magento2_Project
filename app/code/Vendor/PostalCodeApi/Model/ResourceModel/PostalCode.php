<?php
namespace Vendor\PostalCodeApi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PostalCode extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('directory_city_postal_codes', 'entity_id');
    }
}
