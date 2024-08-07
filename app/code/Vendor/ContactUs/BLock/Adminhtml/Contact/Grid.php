<?php
namespace Vendor\ContactUs\Block\Adminhtml\Contact;

use Magento\Backend\Block\Widget\Grid\Extended;
use Vendor\ContactUs\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;

class Grid extends Extended
{
    protected $contactCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        ContactCollectionFactory $contactCollectionFactory,
        array $data = []
    ) {
        $this->contactCollectionFactory = $contactCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _prepareCollection()
    {
        $collection = $this->contactCollectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'contact_id',
            [
                'header' => __('ID'),
                'index' => 'contact_id',
                'type' => 'number'
            ]
        );

        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email'
            ]
        );

        $this->addColumn(
            'telephone',
            [
                'header' => __('Telephone'),
                'index' => 'telephone'
            ]
        );

        $this->addColumn(
            'comment',
            [
                'header' => __('Comment'),
                'index' => 'comment'
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'index' => 'created_at',
                'type' => 'datetime'
            ]
        );

        return parent::_prepareColumns();
    }
}
