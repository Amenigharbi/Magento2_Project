<?php
namespace Vendor\Check\Block\Adminhtml\CityPostalCodes;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Framework\View\Element\Template\Context;
use Vendor\Check\Model\ResourceModel\CityPostalCode\CityPostalCodeCollectionFactory;

class Grid extends Extended
{
    protected $collectionFactory;

    public function __construct(
        Context $context,
        CityPostalCodeCollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('city_postal_codes_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'index' => 'entity_id',
                'type' => 'number',
                'width' => '50px'
            ]
        );

        $this->addColumn(
            'region_id',
            [
                'header' => __('Region ID'),
                'index' => 'region_id',
                'type' => 'number'
            ]
        );

        $this->addColumn(
            'postal_code',
            [
                'header' => __('Postal Code'),
                'index' => 'postal_code',
                'type' => 'text'
            ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
