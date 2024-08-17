<?php

namespace Vendor\Check\Controller\City;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\ResourceConnection;

class GetPostalCodes extends Action
{
    protected $resultJsonFactory;
    protected $resourceConnection;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ResourceConnection $resourceConnection
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resourceConnection = $resourceConnection;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $regionId = $this->getRequest()->getParam('region_id');
        
        $connection = $this->resourceConnection->getConnection();
        $select = $connection->select()
            ->from('directory_city_postal_codes', ['postal_code'])
            ->where('region_id = ?', $regionId);

        $postalCodes = $connection->fetchAll($select);

        return $resultJson->setData(['postal_codes' => $postalCodes]);
    }
}
