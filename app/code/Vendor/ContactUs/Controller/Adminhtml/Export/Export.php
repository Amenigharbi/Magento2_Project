<?php
namespace Vendor\ContactUs\Controller\Adminhtml\Export;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\App\Response\Http\FileFactory;
use Vendor\ContactUs\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;

class Export extends \Magento\Backend\App\Action
{
protected $rawFactory;
protected $fileFactory;
protected $contactCollectionFactory;

public function __construct(
Context $context,
RawFactory $rawFactory,
FileFactory $fileFactory,
ContactCollectionFactory $contactCollectionFactory
) {
parent::__construct($context);
$this->rawFactory = $rawFactory;
$this->fileFactory = $fileFactory;
$this->contactCollectionFactory = $contactCollectionFactory;
}

protected function _isAllowed()
{
return $this->_authorization->isAllowed('Vendor_ContactUs::export');
}

public function execute()
{
$fileName = 'contacts_export.csv';
$content = $this->getCsvFile();
return $this->fileFactory->create(
$fileName,
$content,
\Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR
);
}

protected function getCsvFile()
{
$collection = $this->contactCollectionFactory->create();
$csvData = [];
$csvHeader = ['ID', 'Name', 'Email', 'Telephone', 'Comment', 'Created At'];
$csvData[] = $csvHeader;

foreach ($collection as $item) {
$csvData[] = [
$item->getId(),
$item->getName(),
$item->getEmail(),
$item->getTelephone(),
$item->getComment(),
$item->getCreatedAt()
];
}

$handle = fopen('php://memory', 'w');
foreach ($csvData as $line) {
fputcsv($handle, $line);
}
fseek($handle, 0);
$content = stream_get_contents($handle);
fclose($handle);

return $content;
}
}
?>
