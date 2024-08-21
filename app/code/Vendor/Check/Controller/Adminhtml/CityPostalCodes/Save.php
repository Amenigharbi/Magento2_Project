<?php
namespace Vendor\Check\Controller\Adminhtml\CityPostalCodes;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    protected $cityPostalCodeFactory;
    protected $cityPostalCodeRepository;

    public function __construct(
        Action\Context $context,
        \Vendor\Check\Model\CityPostalCodeFactory $cityPostalCodeFactory,
        \Vendor\Check\Model\CityPostalCodeRepository $cityPostalCodeRepository
    ) {
        parent::__construct($context);
        $this->cityPostalCodeFactory = $cityPostalCodeFactory;
        $this->cityPostalCodeRepository = $cityPostalCodeRepository;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->cityPostalCodeFactory->create();

        if (isset($data['entity_id'])) {
            $model->load($data['entity_id']);
        }

        $model->setData($data);
        try {
            $this->cityPostalCodeRepository->save($model);
            $this->messageManager->addSuccessMessage(__('The postal code has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error saving postal code.'));
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }
}
