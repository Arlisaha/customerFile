$(document).ready(function () {
    ids.forEach(initializeAutocomplete);
});

function initializeAutocomplete(id) {
    var element = document.getElementById(id);
    if (element) {
        var autocomplete = new google.maps.places.Autocomplete(
            element,
            {types: ['geocode'],
            componentRestrictions: {
                country: 'FR'
            }}
        );
        google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
    }
}

function onPlaceChanged() {
    ids.forEach(function (id) {
        $('#' + id).val('');
    });
    var place = this.getPlace();

     console.log(place);  // Uncomment this line to view the full object returned by Google API.

    for (var i in place.address_components) {
        var component = place.address_components[i];
        for (var j in component.types) {  // Some types are ["country", "political"]
            /*Mapping sample variable.
             var mapping = [
             {id: 'form_address', address_components: ['street_number', 'route'], separator: ' '},
             {id: 'form_zipCode', address_components: ['postal_code'], separator: ''},
             {id: 'form_city', address_components: ['locality', 'administrative_area_level_2'], separator: ' - '}
             ];*/
            mapping.forEach(function (associativeArray) {
                var type = component.types[j];
                if ($.inArray(type, associativeArray['address_components']) >= 0) {
                    var id = associativeArray['id'];
                    var separator = associativeArray['separator'];
                    var selector = $('#' + id);
                    var val = selector.val();
                    selector.val((val + separator + component.long_name)
                        .replace(new RegExp('^(' + separator + ')|(' + separator + ')$', 'g'), ''));
                }
            })
        }
    }
}