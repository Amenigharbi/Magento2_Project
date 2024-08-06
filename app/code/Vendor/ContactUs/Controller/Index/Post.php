<?php
namespace Vendor\ContactUs\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vendor\ContactUs\Model\ContactFactory;
use Magento\Framework\Controller\ResultFactory;

class Post extends Action
{
    protected $contactFactory;

    public function __construct(Context $context, ContactFactory $contactFactory)
    {
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }

        $contact = $this->contactFactory->create();
        $contact->setData($data);
        $contact->save();

        $this->messageManager->addSuccessMessage('Thank you for your comment.');

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }
}
