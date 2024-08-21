<?php
namespace Vendor\Check\Controller\Adminhtml\CityPostalCodes;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Vendor_Check::city_postal_codes');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage City Postal Codes'));

        return $resultPage;
    }
}
