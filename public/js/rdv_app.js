/**
 * Manage JS for the application
 */
var RdvApp = {

    run: function () {

        // date rendezvous
        $("#start_date").datetimepicker({
            format: 'yyyy-mm-dd HH:ii',
            autoclose: true
        });

        $("#end_date").datetimepicker({
            format: 'yyyy-mm-dd HH:ii',
            autoclose: true
        });

        // isotope
        var $container = $('#isotope');
        $container.isotope({
            // options
            itemSelector: '.thumbnail',
            layoutMode: 'fitRows'
        });

        // google maps autocomplete
        RdvApp.initialize();

        // manage tabs
        $(".home-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
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
            RdvApp.fillInAddress();
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
            $("#"+component).val('');
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i]['short_name'] +'|'+ place.address_components[i]['long_name'];
                $("#"+addressType).val(val);
            }
        }
    }

}


$(document).ready(function() {
    RdvApp.run();
});