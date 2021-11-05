function handlePlaces(id, fn = null) {
  let places = new google.maps.places.Autocomplete(document.querySelector(`#${id}`));
  google.maps.event.addListener(places, 'place_changed', function () {
    let place = places.getPlace();
    let address = place.formatted_address;
    let latitude = place.geometry.location?.lat();
    let longitude = place.geometry.location?.lng();
    if (fn) {
      $(`.${id}-lng`).val(longitude);
      $(`.${id}-lat`).val(latitude);
    }

    // console.log( place);
    let mesg = "Address: " + address;
    mesg += "\nLatitude: " + latitude;
    mesg += "\nLongitude: " + longitude;
    // document.getElementById(id).value=address;
    if (fn) {
      fn();
    }
  });
}


function checkIdInDOM(id) {
  let element = document.getElementById(id);
  if (typeof (element) != 'undefined' && element != null) return true;
  return false;
}

function initGooglePlaces(arrayOfDOMIds, handleDistance = false) {
  if (Array.isArray(arrayOfDOMIds)) {
    google.maps.event.addDomListener(window, 'load', function () {
      arrayOfDOMIds.forEach((id) => {
        if (checkIdInDOM(id)) {
          if (handleDistance) {
            handlePlaces(id);
          } else {
            handlePlaces(id, checkParamsForMatrix);
          }
        }
      })
    });
  }
}
function callback(response, status) {
  console.log('statusssss', status, 'response:', response);
  let dist = document.getElementById("distance");
  let distInput = document.querySelector("#request-form-0 #distance");
  if (status == "OK") {
    if(distInput){
      distInput.value = response.rows[0].elements[0].distance.text;
    }else{
      dist.value = response.rows[0].elements[0].distance.text;
    }

  } else {
    alert("Error: " + status);
  }
}
function checkParamsForMatrix() {
  const long = $('.pickup-lng').val();
  const lat = $('.pickup-lat').val();
  const pickup = $('#pickup').val();
  const destination = $('#destination').val();
  if (long && lat && destination) {
    distanceResponse = calculateDistance2(lat, long, destination);
  }
}
function calculateDistance2(lat, lng, destination) {
  let origin = new google.maps.LatLng(lat, lng);
  let service = new google.maps.DistanceMatrixService();

  service.getDistanceMatrix(
    {
      origins: [origin],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      avoidHighways: false,
      avoidTolls: false
    },
    callback
  );
}


function removeRoute(id) {
  if (checkIdInDOM(id)) {
    let element = document.getElementById(id);
    element.remove();
  }
}

$(function () {
  // if($("input[type='radio'].type").is(':checked')) {
  //   let id = $("input[type='radio'].type:checked").attr('rel');
  //   let type = $("input[type='radio'].type:checked").val();
  //   handleAmountDisplay(type, id);
  // }
  $('#amountCont').hide();
  $('.type').change(function () {
    let type = $(this).val();
    let id = $(this).attr('rel');
    // alert(id)
    handleAmountDisplay(type, id)

  })
  function handleAmountDisplay(type, id) {
    // let distance = $(`#request-form-${id} #distance`).val();
    let distance = document.querySelector(`#request-form-${id} #distance`).value;
    // alert(distance);
    distance = distance.split(' ')[0];
    distance = parseFloat(distance);
    // alert(distance)
    if (distance) {
      let amount = expressDelievery(distance);
      // alert(amount[type])
      $(`#request-form-${id} #amountCont`).show();
      $(`#request-form-${id} #amount`).show().val(amount[type]);

    }
  }
})
function expressDelievery(distance) {

  if (distance < 10) {
    return {
      regular: 1000,
      express: 2000
    }
  }
  if (distance < 20) {
    return {
      regular: 1500,
      express: 2500
    }
  }
  if (distance < 30) {
    return {
      regular: 2000,
      express: 3500
    }
  }
  if (distance < 40) {
    return {
      regular: 2500,
      express: 4500
    }
  }
  if (distance > 40) {
    return {
      regular: 3000,
      express: 5500
    }
  }
}