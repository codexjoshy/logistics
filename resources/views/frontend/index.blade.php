@extends('layouts.frontend')
@section('slider')
@include('partials.slider')
@endsection
@section('content')
<!-- Contact Callout Start -->
<section class="contact-callout bg-navy-blue wide-tb-70 mb-spacer-md">
  <div class="container">
    <div class="row">
      <!-- Contact Column One -->
      <div class="col-12 col-lg-3 col-sm-6">
        <div class="row align-items-start">
          <div class="col-sm-auto col-2 text-center">
            <i class="icofont-wall-clock icofont-2x"></i>
          </div>
          <div class="col pl-0">
            <h5 class="mb-3 h5-xs fw-6">OPENING HOURS</h5>
            <div class="text">
              Monday - Friday 09.00 - 18.00<br>
              Saturday 09.00 - 14.00
            </div>
          </div>
        </div>
      </div>
      <!-- Contact Column One -->

      <!-- Contact Column One -->
      <div class="col-12 col-lg-3 col-sm-6">
        <div class="row align-items-start">
          <div class="col-sm-auto col-2 text-center">
            <i class="icofont-phone icofont-2x"></i>
          </div>
          <div class="col pl-0">
            <h5 class="mb-3 h5-xs fw-6">CALL US ANYTIME</h5>
            <div class="text">
              +234 (0) 817 500 9200 <br>
              {{-- +234 (0) 81 3597 8939 --}}
            </div>
          </div>
        </div>
      </div>
      <!-- Contact Column One -->

      <!-- Spacer For Medium -->
      <div class="w-100 d-none d-sm-block d-lg-none spacer-60"></div>
      <!-- Spacer For Medium -->

      <!-- Contact Column One -->
      <div class="col-12 col-lg-3 col-sm-6">
        <div class="row align-items-start">
          <div class="col-sm-auto col-2 text-center">
            <i class="icofont-envelope icofont-2x"></i>
          </div>
          <div class="col pl-0">
            <h5 class="mb-3 h5-xs fw-6">EMAIL US</h5>
            <div class="text">
              {{-- <a href="#" class="link-light">info@booklogistic.com</a><br> --}}
              <a href="#" class="link-light">support@booklogistic.com</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Contact Column One -->

      <!-- Contact Column One -->
      <div class="col-12 col-lg-3 col-sm-6">
        <div class="row align-items-start">
          <div class="col-sm-auto col-2 text-center">
            <i class="icofont-envelope-open icofont-2x"></i>
          </div>
          <div class="col pl-0">
            <h5 class="mb-3 h5-xs fw-6">Subscribe to Newsletter</h5>
            <div class="text">
              <a href="#" class="btn-theme bg-light-theme light tra">
                Get Started Now!
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Contact Column One -->
    </div>
  </div>
</section>
<!-- Contact Callout End -->
<!-- Free Quote Start -->
<section class="wide-tb-100 bg-fixed free-quote pb-0" style="background-position: center;">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-7">
        <div class="free-quote-form" id="makeRequest">
          <!-- Heading Main -->
          <h1 class="heading-main mb-4">
            <span>Request a </span>
            Dispatcher
          </h1>
          <!-- Heading Main -->

          <!-- Free Quote From -->
          <form action="{{route('frontend.result')}}" method="get" novalidate="novalidate" class="col rounded-field">
            @csrf
            

            <div class="form-row mb-4">
              <input type="email" name="email" class="form-control" placeholder="Your Email">
            </div>
            
            <div class="form-row mb-4">
              <input type="text" name="pickup" id="pickup" class="form-control txtPlaces"
                placeholder="Enter Pickup Location">
              <div class="form-row mb-1">
                <label rel="more-pickup" class='d-flex justify-content-between more'>
                  <input type="checkbox" rel="more-pickup"><small class="ml-3 more" rel="more-pickup"><strong>Provide
                      more information on pickup location ?</strong></small>
                </label>
              </div>
            </div>
            <div class="form-row mb-4 more-details" id="more-pickup">
              <input type="text" name="morePickup" class="form-control" placeholder="more details for pickup">
            </div>

            {{-- <span class="pickup">pickup</span> --}}
            <div class="form-row mb-4">
              <input type="hidden" name="lng" class="pickup-lng" value="" />
              <input type="hidden" name="lat" class="pickup-lat" value="" />
              <input type="text" name="destination" id="destination" class="form-control txtPlaces"
                placeholder="Enter Destination">
              <div class="form-row mb-1">
                <label rel="more-destination" class='d-flex justify-content-between more'>
                  <input type="checkbox" rel="more-destination"><small class="ml-3 more"
                    rel="more-destination"><strong>Provide more information on delivery location ?</strong></small>
                </label>
              </div>
            </div>
            <div class="form-row mb-4 more-details" id="more-destination">
              <input type="text" name="moreDestination" class="form-control" placeholder="more details for pickup">
            </div>
            {{-- <span class="destination">destination</span> --}}
            {{-- <div class="form-row mb-4">
              <div class="col-6 mb-4">
                <input type="text" name="distance" class="form-control" id="distance" placeholder="Distance">
              </div>
              <div class="col-6">
                <select title="Delievery Type" id="type" required="" name="package" class="form-control wide"
                  aria-required="true" aria-invalid="false">
                  <option value="">Delievery Type</option>
                  <option value="regular">Regular</option>
                  <option value="express">Express</option>
                </select>

              </div>
            </div>
            <div class="form-row mb-4" id="amountCont">
              <div class="col-12 mb-4">
                <input type="text" name="amount" readOnly class="form-control" id="amount" placeholder="Amount">
              </div>
            </div> --}}
            <div class="form-row text-center">
              <button type="submit" class="form-btn mx-auto btn-theme bg-orange">Request Now <i
                  class="icofont-rounded-right"></i></button>
            </div>
          </form>
          <!-- Free Quote From -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Free Quote End -->
<!-- Tracking Your Freight Start -->
<section class="wide-tb-100 pb-0" id="track">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 ml-lg-auto pos-rel col-md-12">

        <!-- Heading Main -->
        <h1 class="heading-main text-left">
          <span>get updates</span>
          Tracking Your Items
        </h1>
        <!-- Heading Main -->

        <!-- Tracking Form -->
        <div id="error"></div>
        <form class="form-inline tracking">
          <input id="order" name="order" type="text" class="form-control mb-2 mr-sm-2 col"
            placeholder="Enter order number e.g 38c56o43">
          <input id="otp" name="otp" type="text" class="form-control mb-2 mr-sm-2 col" placeholder="Enter OTP">
          <button type="button" id="findOrder" class="btn btn-theme bg-navy-blue mb-2 ml-3">Check Now <i
              class="icofont-rounded-right"></i></button>
        </form>
        <div id="response">

        </div>
        <!-- Tracking Form -->

        <!-- Forklift Image -->
        <div class="forklift-image wow slideInLeft" data-wow-duration="0" data-wow-delay="0s">
          <img src="assets/images/forklift_Image.png" alt="">
        </div>
        <!-- Forklift Image -->

      </div>
    </div>
  </div>
</section>
<!-- Tracking Your Freight End -->
<!-- Client Testimonials Start -->
<section class="wide-tb-80 bg-navy-blue callout-style-1 wow fadeInUp" data-wow-duration="0" data-wow-delay="0s">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4 col-md-12 mb-0">
        <h4 class="h4-xl">Interested in partnering with Booklogistic ?</h4>
      </div>
      <div class="col">
        <div class="center-text">
          WE ARE READY TO ASSIST YOU WITH YOUR ORDERS
        </div>
      </div>
      <div class="col-sm-auto">
        <a href="{{route('frontend.contact')}}" class="btn-theme bg-white light">Get In Touch <i
            class="icofont-rounded-right"></i></a>
      </div>
    </div>
  </div>
</section>
<!-- Client Testimonials End -->
@push('scripts')
{{-- <scriptasas defer type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api')}}&sensor=false&libraries=places">
  </scriptas> --}}
  <script>
    $(function(){
        $('#order').focus(function(){
          $('#error').html('');
        })
          $('#otp').fadeOut();
          $('#findOrder').click(function(e){
            e.preventDefault();
            let order = $('#order').val();
            let otp = $('#otp').val();
            order = order.toLowerCase();
            otp = otp.toLowerCase();
            let url = "{{route('check.order')}}";
            let data = {order,_token:"{{csrf_token()}}"};
            if(otp) url = "{{route('check.order.otp')}}";
            if(otp) data.otp = otp;
            $.ajax({
              url, 
              type: 'POST',
              data,
              beforeSend: function(){
                $('#error').html('');
                $('#response').html('')
              },
              success: function(data, textStatus, xhr) {
                // console.log(xhr);
                // let response = JSON.parse(data);
                // console.log(xhr, data);
                if(!otp){
                  $('#otp').fadeIn(1500).attr('required', true);
                }else{
                  const {name, orderDate, status, company, sender, recipient} = data?.payload;
                  // console.log(data);
                  let statusMessage = status;
                  if(status == 'accepted'){
                    statusMessage = "Ready For Pickup";
                  }
                  $('#response').html(`<div class="alert alert-success">
                    <div class='row'>
                      <div class="col">
                        <h3>Hello ${name}</h3>
                        <p>Find Below Order Details</p>
                        <p><strong>Date Ordered: ${orderDate}</strong></p>
                        <p><strong>Order Status: <strong>${statusMessage}</strong> </strong></p>
                        <p><strong>Company: ${company}</strong></p>
                        <p><strong>Sender: ${sender}</strong></p>
                        <p><strong>Recipient: ${recipient}</strong></p>
                      </div>
                    </div>
                  </div>`);

                }
                
              },
              error: function(jqXHR, textStatus, errorThrown) {
                const {message} = jqXHR.responseJSON;
                // console.log(jqXHR.responseJSON);
                $('#error').html(`<div class='alert bg-danger text-white'>${message}</div>`);
                
              }
              
            })
            
          })
        })
  </script>
  <script>
    $('.more-details').hide();
    $(function(){
      $('.more').click(function(){
        let id = $(this).attr('rel');
        $(`#${id}`).toggle();

      })
    })
  </script>
  <script>
    $(function(){
      $('#amountCont').hide();
      $('.type').change(function() {
        let type = $(this).val();
        let distance = $('#distance').val();
        distance = parseFloat(distance);
        $('#amountCont').show();
        $('#amount').show().val(amount);
        let idSelected = `#amount`;
        let amount = expressDelievery(distance, type, idSelected);

      })
    })
    function expressDelievery(distance, type, id) {
      const _token = "{{csrf_token()}}";
      $.ajax({
          url:"{{route('generate.price')}}",
          type: 'POST',
          data:{distance, type, _token},
          success: function (data){
            let amount = data?.payload;
            $(id).show().val(amount);
          }
      })

        return;

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
  </script>
  <script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
              ['destination', 'pickup'].forEach((id)=>{
                handlePlaces(id, checkParamsForMatrix)
              })
            });
            function checkParamsForMatrix() {
              const long = $('.pickup-lng').val();
              const lat = $('.pickup-lat').val();
              const pickup = $('#pickup').val();
              const destination = $('#destination').val();
              if(long && lat && destination) {
                distanceResponse = calculateDistance2(lat, long, destination);
              }
            }
            function handlePlaces(id, fn) {
              let places = new google.maps.places.Autocomplete(document.getElementById(id));
                google.maps.event.addListener(places, 'place_changed', function () {
                    let place = places.getPlace();
                    let address = place.formatted_address;
                    let latitude = place.geometry.location?.lat();
                    let longitude = place.geometry.location?.lng();
                    $(`.${id}-lng`).val(longitude);
                    $(`.${id}-lat`).val(latitude);
                    console.log('latitude',latitude, place.geometry.location.lng());
                    let mesg = "Address: " + address;
                    mesg += "\nLatitude: " + latitude;
                    mesg += "\nLongitude: " + longitude;
                    
                    fn();
                    // alert(mesg);
                });
            }
            function calculateDistance(origin, destination) {
              const apiKey = "{{config('app.google_api')}}";

              var config = {
                method: 'get',
                url:`https://maps.googleapis.com/maps/api/distancematrix/json?origins=${origin}&destinations=${destination}&departure_time=now&key=${apiKey}`,
                headers: { }
              };

              fetch(config)
              // .then(res=>res.json())
              .then(function (response) {
                console.log(response);
                return response
              })
              .catch(function (error) {
                console.log(error);
              });
            }

            function calculateDistance2(lat, lng, destination) {
              let origin = new google.maps.LatLng(lat, lng);
              let  service = new google.maps.DistanceMatrixService();
            
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
            function callback(response, status) {
              let dist = document.getElementById("distance");
              if(status=="OK") {             
                  dist.value = response.rows[0].elements[0].distance.text;
              } else {
                  alert("Error: " + status);
              }
            }
  </script>
  @endpush

  @endsection
