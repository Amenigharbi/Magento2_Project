<?php
namespace Magento\AsynchronousOperations\Model\MassSchedule;

/**
 * Interceptor class for @see \Magento\AsynchronousOperations\Model\MassSchedule
 */
class Interceptor extends \Magento\AsynchronousOperations\Model\MassSchedule implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\DataObject\IdentityGeneratorInterface $identityService, \Magento\AsynchronousOperations\Api\Data\ItemStatusInterfaceFactory $itemStatusInterfaceFactory, \Magento\AsynchronousOperations\Api\Data\AsyncResponseInterfaceFactory $asyncResponseFactory, \Magento\Framework\Bulk\BulkManagementInterface $bulkManagement, \Psr\Log\LoggerInterface $logger, \Magento\AsynchronousOperations\Model\OperationRepositoryInterface $operationRepository, \Magento\Authorization\Model\UserContextInterface $userContext, \Magento\Framework\Encryption\Encryptor $encryptor, \Magento\AsynchronousOperations\Api\SaveMultipleOperationsInterface $saveMultipleOperations)
    {
        $this->___init();
        parent::__construct($identityService, $itemStatusInterfaceFactory, $asyncResponseFactory, $bulkManagement, $logger, $operationRepository, $userContext, $encryptor, $saveMultipleOperations);
    }

    /**
     * {@inheritdoc}
     */
    public function publishMass($topicName, array $entitiesArray, $groupId = null, $userId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'publishMass');
        return $pluginInfo ? $this->___callPlugins('publishMass', func_get_args(), $pluginInfo) : parent::publishMass($topicName, $entitiesArray, $groupId, $userId);
    }
}
