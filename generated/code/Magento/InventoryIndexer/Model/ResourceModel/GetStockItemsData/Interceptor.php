<?php
namespace Magento\InventoryIndexer\Model\ResourceModel\GetStockItemsData;

/**
 * Interceptor class for @see \Magento\InventoryIndexer\Model\ResourceModel\GetStockItemsData
 */
class Interceptor extends \Magento\InventoryIndexer\Model\ResourceModel\GetStockItemsData implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resource, \Magento\InventoryIndexer\Model\StockIndexTableNameResolverInterface $stockIndexTableNameResolver, \Magento\InventoryCatalogApi\Api\DefaultStockProviderInterface $defaultStockProvider, \Magento\InventoryIndexer\Model\ResourceModel\StockItemDataHandler $stockItemDataHandler)
    {
        $this->___init();
        parent::__construct($resource, $stockIndexTableNameResolver, $defaultStockProvider, $stockItemDataHandler);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $skus, int $stockId) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($skus, $stockId);
    }
}
