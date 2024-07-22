<?php
namespace Training\PluginExample\Model\ProductKey;

/**
 * Interceptor class for @see \Training\PluginExample\Model\ProductKey
 */
class Interceptor extends \Training\PluginExample\Model\ProductKey implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function getKey(\Magento\Catalog\Api\Data\ProductInterface $product, string $prefix = 'Item') : string
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getKey');
        return $pluginInfo ? $this->___callPlugins('getKey', func_get_args(), $pluginInfo) : parent::getKey($product, $prefix);
    }
}
