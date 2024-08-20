define('Vendor_Check/js/postal-code', [
    'jquery',
    'mage/url',
    'Magento_Checkout/js/model/quote'
], function ($, urlBuilder, quote) {
    'use strict';
    console.log("Postal Code script loaded");

    return function (target) {
        return target.extend({
            initialize: function () {
                this._super();
                
                this.waitForElements();

                return this;
            },

            waitForElements: function () {
                var self = this;
                var intervalId = setInterval(function () {
                    var countrySelect = $('[name="country_id"]');
                    var regionSelect = $('[name="region_id"]');
                    var postalCodeSelect = $('[name="custom_postcode"]'); // Use custom_postcode for dropdown

                    if (countrySelect.length && regionSelect.length && postalCodeSelect.length) {
                        console.log('Country Select Element:', countrySelect);
                        console.log('Region Select Element:', regionSelect);
                        console.log('Postal Code Select Element:', postalCodeSelect);

                        countrySelect.on('change', self.handleCountryChange.bind(self));
                        regionSelect.on('change', self.handleCityChange.bind(self));

                        clearInterval(intervalId); // Stop checking once elements are found
                    } else {
                        console.log("Country, region or postal code select elements not yet available.");
                    }
                }, 500); // Adjust the interval time as needed
            },

            handleCountryChange: function (event) {
                var selectedCountryId = $(event.target).val();
                console.log("Selected country:", selectedCountryId);

                this.clearPostalCodes();

                // Reset the region selection when the country changes
                $('[name="region_id"]').val('');
            },

            handleCityChange: function (event) {
                var selectedRegionId = $(event.target).val();
                var selectedCountryId = $('[name="country_id"]').val();
                console.log("Selected region:", selectedRegionId);

                if (selectedRegionId && selectedCountryId) {
                    this.updatePostalCodes(selectedRegionId);
                } else {
                    this.clearPostalCodes();
                }
            },

            updatePostalCodes: function (regionId) {
                var self = this;

                if (regionId) {
                    console.log("Fetching postal codes for region:", regionId);
                    var serviceUrl = urlBuilder.build('check/city/getPostalCodes?region_id=' + regionId);

                    $.getJSON(serviceUrl, function (data) {
                        console.log("API response:", data);
                        if (Array.isArray(data.postal_codes)) {
                            var postalCodeSelect = $('[name="custom_postcode"]'); // Use custom_postcode for dropdown
                            postalCodeSelect.empty();
                            postalCodeSelect.append('<option value="">Please select a postal code</option>');
                            $.each(data.postal_codes, function (index, postalCode) {
                                postalCodeSelect.append('<option value="' + postalCode + '">' + postalCode + '</option>');
                            });
                        } else {
                            console.log('Invalid data format received from the server.');
                        }
                    }).fail(function () {
                        console.log('AJAX request failed.');
                    });
                }
            },

            clearPostalCodes: function () {
                var postalCodeSelect = $('[name="custom_postcode"]'); // Use custom_postcode for dropdown
                postalCodeSelect.empty();
                postalCodeSelect.append('<option value="">Please select a postal code</option>');
            }
        });
    };
});
