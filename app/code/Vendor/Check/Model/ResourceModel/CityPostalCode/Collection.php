<?php
namespace Vendor\Check\Model\ResourceModel\CityPostalCode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vendor\Check\Model\CityPostalCode as Model;
use Vendor\Check\Model\ResourceModel\CityPostalCode as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
