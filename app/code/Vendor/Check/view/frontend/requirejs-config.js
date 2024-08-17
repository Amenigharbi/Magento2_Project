var config = {
    map: {
        '*': {
            'postal-code': 'Vendor_Check/js/postal-code'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Vendor_Check/js/postal-code': true
            }
        }
    }
};
