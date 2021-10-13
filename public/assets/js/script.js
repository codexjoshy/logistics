function handlePlaces(id, fn) {
    console.log(id);
    let places = new google.maps.places.Autocomplete(document.querySelector(`#${id}`));
    console.log(places);
    google.maps.event.addListener(places, 'place_changed', function () {
        let place = places.getPlace();
        let address = place.formatted_address;
        let latitude = place.geometry.location?.lat();
        let longitude = place.geometry.location?.lng();
        // $(`.${id}-lng`).val(longitude);
        // $(`.${id}-lat`).val(latitude);
        console.log( place);
        let mesg = "Address: " + address;
        mesg += "\nLatitude: " + latitude;
        mesg += "\nLongitude: " + longitude;
        // document.getElementById(id).value=address;
        // fn();
    });
}


function checkIdInDOM(id) {
    let element = document.getElementById(id);
    if (typeof(element) != 'undefined' && element != null) return true;
    return false;
}

function initGooglePlaces(arrayOfDOMIds) {
    if(Array.isArray(arrayOfDOMIds)) {
        google.maps.event.addDomListener(window, 'load', function () {
            arrayOfDOMIds.forEach((id)=>{
                if (checkIdInDOM(id)) {
                    handlePlaces(id);
                }
          })
        });
    }
}

function removeRoute(id) {
    if (checkIdInDOM(id)) {
        let element = document.getElementById(id);
        element.remove();
    }
}
