<?php
namespace AmeniMage\Example\Controller\Layout\Index;

/**
 * Interceptor class for @see \AmeniMage\Example\Controller\Layout\Index
 */
class Interceptor extends \AmeniMage\Example\Controller\Layout\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\PageFactory $page)
    {
        $this->___init();
        parent::__construct($page);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }
}
