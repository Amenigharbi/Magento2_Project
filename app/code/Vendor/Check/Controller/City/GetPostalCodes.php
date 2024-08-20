<?php
namespace Vendor\Check\Controller\City;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Action;
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
        $regionId = $this->getRequest()->getParam('region_id');
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('directory_city_postal_codes');

        $select = $connection->select()
            ->from($tableName, ['postal_code'])
            ->where('region_id = ?', $regionId);

        $postalCodes = $connection->fetchCol($select);

        $result = ['postal_codes' => $postalCodes];

        return $this->resultJsonFactory->create()->setData($result);
    }
}
