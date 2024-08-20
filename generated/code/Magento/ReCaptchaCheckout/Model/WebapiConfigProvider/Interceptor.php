<?php
namespace Magento\ReCaptchaCheckout\Model\WebapiConfigProvider;

/**
 * Interceptor class for @see \Magento\ReCaptchaCheckout\Model\WebapiConfigProvider
 */
class Interceptor extends \Magento\ReCaptchaCheckout\Model\WebapiConfigProvider implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface $isEnabled, \Magento\ReCaptchaUi\Model\ValidationConfigResolverInterface $configResolver)
    {
        $this->___init();
        parent::__construct($isEnabled, $configResolver);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigFor(\Magento\ReCaptchaWebapiApi\Api\Data\EndpointInterface $endpoint) : ?\Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfigFor');
        return $pluginInfo ? $this->___callPlugins('getConfigFor', func_get_args(), $pluginInfo) : parent::getConfigFor($endpoint);
    }
}
