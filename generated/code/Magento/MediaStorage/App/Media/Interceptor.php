<?php
namespace Magento\MediaStorage\App\Media;

/**
 * Interceptor class for @see \Magento\MediaStorage\App\Media
 */
class Interceptor extends \Magento\MediaStorage\App\Media implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\MediaStorage\Model\File\Storage\ConfigFactory $configFactory, \Magento\MediaStorage\Model\File\Storage\SynchronizationFactory $syncFactory, \Magento\MediaStorage\Model\File\Storage\Response $response, \Closure $isAllowed, $mediaDirectory, $configCacheFile, $relativeFileName, \Magento\Framework\Filesystem $filesystem, \Magento\Catalog\Model\View\Asset\PlaceholderFactory $placeholderFactory, \Magento\Framework\App\State $state, \Magento\MediaStorage\Service\ImageResize $imageResize, \Magento\Framework\Filesystem\Driver\File $file, ?\Magento\Catalog\Model\Config\CatalogMediaConfig $catalogMediaConfig = null)
    {
        $this->___init();
        parent::__construct($configFactory, $syncFactory, $response, $isAllowed, $mediaDirectory, $configCacheFile, $relativeFileName, $filesystem, $placeholderFactory, $state, $imageResize, $file, $catalogMediaConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function launch() : \Magento\Framework\App\ResponseInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'launch');
        return $pluginInfo ? $this->___callPlugins('launch', func_get_args(), $pluginInfo) : parent::launch();
    }

    /**
     * {@inheritdoc}
     */
    public function catchException(\Magento\Framework\App\Bootstrap $bootstrap, \Exception $exception)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'catchException');
        return $pluginInfo ? $this->___callPlugins('catchException', func_get_args(), $pluginInfo) : parent::catchException($bootstrap, $exception);
    }
}
