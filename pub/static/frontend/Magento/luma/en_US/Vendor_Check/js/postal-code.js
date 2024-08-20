define('Vendor_Check/js/postal-code', [
    'jquery',
    'mage/url',
    'Magento_Checkout/js/model/quote'
], function ($, urlBuilder, quote) {
    'use strict';
    console.log("loaded");

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
                    var countrySelect = $('[name=country_id]');
                    var citySelect = $('[name=region_id]');

                    if (countrySelect.length && citySelect.length) {
                        console.log('Country Select Element:', countrySelect);
                        console.log('City Select Element:', citySelect);

                        // Lier l'événement change du sélecteur de pays
                        countrySelect.on('change', self.handleCountryChange.bind(self));
                        // Lier l'événement change du sélecteur de ville
                        citySelect.on('change', self.handleCityChange.bind(self));

                        clearInterval(intervalId); // Arrêter de vérifier une fois que les éléments sont trouvés
                    } else {
                        console.log("Les éléments select pour le pays et/ou la ville ne sont pas encore disponibles.");
                    }
                }, 500); // Vérifier toutes les 500ms (ajustez selon vos besoins)
            },

            handleCountryChange: function (event) {
                var selectedCountryId = $(event.target).val();
                console.log("Pays sélectionné:", selectedCountryId);

                this.clearPostalCodes();

                if (selectedCountryId) {
                    // Vous pouvez également déclencher une mise à jour des villes disponibles ici si nécessaire
                }
            },

            handleCityChange: function (event) {
                var selectedCity = $(event.target).val();
                var selectedCountryId = $('[name=country_id]').val();
                console.log("Ville sélectionnée:", selectedCity);

                if (selectedCity && selectedCountryId) {
                    this.updatePostalCodes(selectedCountryId, selectedCity);
                } else {
                    this.clearPostalCodes();
                }
            },

            updatePostalCodes: function (countryId, city) {
                var self = this;

                if (countryId && city) {
                    console.log("Récupération des codes postaux pour le pays:", countryId, "et la ville:", city);
                    var serviceUrl = urlBuilder.build('check/city/getPostalCodes?country_id=' + countryId + '&city=' + city);

                    $.getJSON(serviceUrl, function (data) {
                        console.log("Réponse de l'API:", data);
                        if (Array.isArray(data.postal_codes)) {
                            var postalCodeSelect = $('[name=postcode]');
                            postalCodeSelect.empty();
                            postalCodeSelect.append('<option value="">Please select a postal code</option>');
                            $.each(data.postal_codes, function (index, postalCode) {
                                postalCodeSelect.append('<option value="' + postalCode + '">' + postalCode + '</option>');
                            });
                        } else {
                            console.log('Format de données invalide reçu du serveur.');
                        }
                    }).fail(function () {
                        console.log('La requête AJAX a échoué.');
                    });
                }
            },

            clearPostalCodes: function () {
                var postalCodeSelect = $('[name=postcode]');
                postalCodeSelect.empty();
                postalCodeSelect.append('<option value="">Please select a postal code</option>');
            }
        });
    };
});
