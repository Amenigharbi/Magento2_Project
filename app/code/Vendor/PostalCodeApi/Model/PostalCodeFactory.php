<?php
namespace Vendor\PostalCodeApi\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PostalCodeFactory
{
    protected $objectManager;

    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create()
    {
        return $this->objectManager->create('Vendor\PostalCodeApi\Model\PostalCode');
    }
}
