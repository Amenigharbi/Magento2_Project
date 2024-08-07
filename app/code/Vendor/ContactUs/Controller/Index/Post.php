<?php
namespace Vendor\ContactUs\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vendor\ContactUs\Model\ContactFactory;
use Magento\Framework\Controller\ResultFactory;
use Vendor\ContactUs\Helper\PhoneHelper; // Ajout de PhoneHelper

class Post extends Action
{
    protected $contactFactory;
    protected $phoneHelper; // Ajout de phoneHelper

    public function __construct(Context $context, ContactFactory $contactFactory, PhoneHelper $phoneHelper)
    {
        $this->contactFactory = $contactFactory;
        $this->phoneHelper = $phoneHelper; // Initialisation de phoneHelper
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }

        $telephone = isset($data['telephone']) ? $data['telephone'] : '';
        if (!$this->phoneHelper->isValidNumber($telephone, 'TN')) {  // 'TN' pour la Tunisie
            $this->messageManager->addErrorMessage('Invalid telephone number.');
            $this->_redirect('*/*/');
            return;
        }

        $contact = $this->contactFactory->create();
        $contact->setData($data);
        $contact->save();

        $this->messageManager->addSuccessMessage('Thank you for contact us !.');

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }
}
