/**
 * Manage JS for the google maps api
 */
var RdvMaps = {

    run: function () {

        // google maps autocomplete
        RdvMaps.initialize();

        $("#search_autocomplete").blur(function (e) {
            var search = $(this).val();
            console.log(search);
            var service = new google.maps.places.AutocompleteService();
            service.getQueryPredictions({ input: search }, function(predictions, status) {
                if (status != google.maps.places.PlacesServiceStatus.OK) {
                    alert(status);
                    return;
                }

                console.log(predictions[0]);

            });
        });

    },

    initialize: function () {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('search_autocomplete')),
            { types: ['geocode'] });
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            RdvMaps.fillInAddress();
        });
    },


    fillInAddress: function () {

        var componentForm = {
            //street_number: 'short_name',
            //route: 'long_name',
            locality: '1',
            sublocality_level_1: '1',
            administrative_area_level_1: '1',
            administrative_area_level_2: '1',
            country: '1',
            postal_code: '1',
            postal_code_prefix: '1'
        };

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        console.log(place);

        for (var component in componentForm) {
            $("#short_"+component).val('');
            $("#long_"+component).val('');
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                $("#short_"+addressType).val(place.address_components[i]['short_name']);
                $("#long_"+addressType).val(place.address_components[i]['long_name']);
            }
        }
    }


}


$(document).ready(function() {
    RdvMaps.run();
});