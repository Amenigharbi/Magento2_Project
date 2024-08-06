<?php
namespace Vendor\ContactUs\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vendor\ContactUs\Model\Contact', 'Vendor\ContactUs\Model\ResourceModel\Contact');
    }
}
