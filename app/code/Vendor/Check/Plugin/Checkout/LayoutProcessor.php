<?php

namespace Vendor\Check\Plugin\Checkout;

use Vendor\Check\Model\CityPostalCodeRepository;

class LayoutProcessor
{
    protected $cityPostalCodeRepository;

    public function __construct(CityPostalCodeRepository $cityPostalCodeRepository)
    {
        $this->cityPostalCodeRepository = $cityPostalCodeRepository;
    }

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        // Define the custom field configuration
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'custom_postcode',
                'options' => [] // This will be populated dynamically
            ],
            'dataScope' => 'shippingAddress.custom_postcode',
            'label' => __('Postal Code'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 250,
            'validation' => [
                'required-entry' => true
            ]
        ];

        // Insert the custom field into the layout
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_postcode'] = $customField;

        return $jsLayout;
    }
}
