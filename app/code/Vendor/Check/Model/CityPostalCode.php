<?php

namespace Vendor\Check\Model;

use Magento\Framework\Model\AbstractModel;

class CityPostalCode extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Vendor\Check\Model\ResourceModel\CityPostalCode::class);
    }
}
