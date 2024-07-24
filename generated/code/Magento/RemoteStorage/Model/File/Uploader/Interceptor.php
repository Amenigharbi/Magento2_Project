<?php
namespace Magento\RemoteStorage\Model\File\Uploader;

/**
 * Interceptor class for @see \Magento\RemoteStorage\Model\File\Uploader
 */
class Interceptor extends \Magento\RemoteStorage\Model\File\Uploader implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct($fileId, ?\Magento\Framework\File\Mime $fileMime = null, ?\Magento\Framework\App\Filesystem\DirectoryList $directoryList = null, ?\Magento\Framework\Filesystem\DriverPool $driverPool = null, ?\Magento\Framework\Filesystem\Directory\TargetDirectory $targetDirectory = null, ?\Magento\Framework\Filesystem $filesystem = null, ?\Magento\RemoteStorage\Model\Config $config = null)
    {
        $this->___init();
        parent::__construct($fileId, $fileMime, $directoryList, $driverPool, $targetDirectory, $filesystem, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function save($destinationFolder, $newFileName = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save($destinationFolder, $newFileName);
    }

    /**
     * {@inheritdoc}
     */
    public function getFileExtension()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFileExtension');
        return $pluginInfo ? $this->___callPlugins('getFileExtension', func_get_args(), $pluginInfo) : parent::getFileExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function addValidateCallback($callbackName, $callbackObject, $callbackMethod)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addValidateCallback');
        return $pluginInfo ? $this->___callPlugins('addValidateCallback', func_get_args(), $pluginInfo) : parent::addValidateCallback($callbackName, $callbackObject, $callbackMethod);
    }

    /**
     * {@inheritdoc}
     */
    public function removeValidateCallback($callbackName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'removeValidateCallback');
        return $pluginInfo ? $this->___callPlugins('removeValidateCallback', func_get_args(), $pluginInfo) : parent::removeValidateCallback($callbackName);
    }

    /**
     * {@inheritdoc}
     */
    public function correctFileNameCase($fileName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'correctFileNameCase');
        return $pluginInfo ? $this->___callPlugins('correctFileNameCase', func_get_args(), $pluginInfo) : parent::correctFileNameCase($fileName);
    }

    /**
     * {@inheritdoc}
     */
    public function checkMimeType($validTypes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'checkMimeType');
        return $pluginInfo ? $this->___callPlugins('checkMimeType', func_get_args(), $pluginInfo) : parent::checkMimeType($validTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function getUploadedFileName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUploadedFileName');
        return $pluginInfo ? $this->___callPlugins('getUploadedFileName', func_get_args(), $pluginInfo) : parent::getUploadedFileName();
    }

    /**
     * {@inheritdoc}
     */
    public function setAllowCreateFolders($flag)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAllowCreateFolders');
        return $pluginInfo ? $this->___callPlugins('setAllowCreateFolders', func_get_args(), $pluginInfo) : parent::setAllowCreateFolders($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function setAllowRenameFiles($flag)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAllowRenameFiles');
        return $pluginInfo ? $this->___callPlugins('setAllowRenameFiles', func_get_args(), $pluginInfo) : parent::setAllowRenameFiles($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function setFilesDispersion($flag)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFilesDispersion');
        return $pluginInfo ? $this->___callPlugins('setFilesDispersion', func_get_args(), $pluginInfo) : parent::setFilesDispersion($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function setFilenamesCaseSensitivity($flag)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFilenamesCaseSensitivity');
        return $pluginInfo ? $this->___callPlugins('setFilenamesCaseSensitivity', func_get_args(), $pluginInfo) : parent::setFilenamesCaseSensitivity($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function setAllowedExtensions($extensions = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAllowedExtensions');
        return $pluginInfo ? $this->___callPlugins('setAllowedExtensions', func_get_args(), $pluginInfo) : parent::setAllowedExtensions($extensions);
    }

    /**
     * {@inheritdoc}
     */
    public function checkAllowedExtension($extension)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'checkAllowedExtension');
        return $pluginInfo ? $this->___callPlugins('checkAllowedExtension', func_get_args(), $pluginInfo) : parent::checkAllowedExtension($extension);
    }
}
