<?php
namespace Vendor\Check\Plugin\Checkout;

class LayoutProcessor
{
    public function aroundProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        \Closure $proceed,
        array $jsLayout
    ) {
        // Execute the default LayoutProcessor behavior
        $jsLayoutResult = $proceed($jsLayout);

        // Check if the shipping address fieldset exists
        if (isset($jsLayoutResult['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']
        )) {
            $shippingAddressFieldset = &$jsLayoutResult['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children'];

            // Remove the "Postal Code" field
            if (isset($shippingAddressFieldset['postcode'])) {
                unset($shippingAddressFieldset['postcode']);
            }

            // Remove the "City" field
            if (isset($shippingAddressFieldset['city'])) {
                unset($shippingAddressFieldset['city']);
            }

            // Change the label of the "State/Province" field
            if (isset($shippingAddressFieldset['region_id'])) {
                $shippingAddressFieldset['region_id']['label'] = __('City');
            }

            // Add a dropdown menu for "Postal Code"
            $shippingAddressFieldset['custom_postcode'] = [
                'component' => 'Magento_Ui/js/form/element/select',
                'config' => [
                    'customScope' => 'shippingAddress',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/select',
                    'options' => [
                        
                    ],
                ],
                'dataScope' => 'shippingAddress.custom_postcode',
                'label' => __('Postal Code'),
                'provider' => 'checkoutProvider',
                'visible' => true,
                'sortOrder' => 90, 
                'required' => true,
            ];
        }

        return $jsLayoutResult;
    }
}
