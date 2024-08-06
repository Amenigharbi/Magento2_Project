<?php
namespace Vendor\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vendor\ContactUs\Model\ResourceModel\Contact');
    }
}
