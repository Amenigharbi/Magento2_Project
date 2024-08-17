define([
    'uiComponent',
    'jquery',
    'mage/url',
    'Magento_Checkout/js/model/quote'
], function (Component, $, urlBuilder, quote) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            this.updatePostalCodes();
            return this;
        },
        updatePostalCodes: function () {
            var self = this;
            this.observe('region_id').subscribe(function (value) {
                if (value) {
                    var serviceUrl = urlBuilder.build('check/city/getPostalCodes?region_id=' + value);
                    $.getJSON(serviceUrl, function (data) {
                        var $postalCodeSelect = $('#custom_postcode');
                        $postalCodeSelect.empty();
                        $.each(data.postal_codes, function (index, postalCode) {
                            $postalCodeSelect.append($('<option>').text(postalCode.postal_code).attr('value', postalCode.postal_code));
                        });
                    }).fail(function() {
                        console.error('La requête AJAX a échoué.');
                    });
                }
            });
        }
    });
});
