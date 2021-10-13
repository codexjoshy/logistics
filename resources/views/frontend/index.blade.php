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
                    +234 (0) 806 500 9200 <br>
                    +234 (0) 81 3597 8939 
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
                    <a href="#" class="link-light">info@booklogistic.com</a><br>
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
                <div class="free-quote-form">
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
                          <input type="text" name="name" class="form-control" placeholder="Your FullName">
                          @error('name')
                            {{$message}}
                          @enderror
                      </div>
                      
                      <div class="form-row mb-4">
                          <input type="email" name="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="form-row mb-4">
                          <input type="text" name="phone" class="form-control" placeholder="Phone">
                      </div>
                      <div class="form-row mb-4">
                          <input type="text" name="pickup" id="pickup" class="form-control txtPlaces" placeholder="Enter Pickup Location" >
                      </div>
                      {{-- <span class="pickup">pickup</span> --}}
                      <div class="form-row mb-4">
                          <input type="hidden" name="lng" class="pickup-lng" value="" />
                          <input type="hidden" name="lat" class="pickup-lat" value="" />
                          <input type="text" name="destination" id="destination" class="form-control txtPlaces" placeholder="Enter Destination">
                      </div>
                      {{-- <span class="destination">destination</span> --}}
                      {{-- <div class="form-row mb-4">
                        <div class="col-6 mb-4">
                          <input type="text" name="distance" class="form-control" id="distance" placeholder="Distance">
                        </div>
                        <div class="col-6">
                          <select title="Delievery Type" id="type" required="" name="package" class="form-control wide" aria-required="true" aria-invalid="false">
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
                      </div>  --}}
                      <div class="form-row text-center">
                          <button type="submit" class="form-btn mx-auto btn-theme bg-orange">Request Now <i class="icofont-rounded-right"></i></button>
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
      <section class="wide-tb-100 pb-0">
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
                <form class="form-inline tracking">
                  <input type="text" class="form-control mb-2 mr-sm-2 col" placeholder="Enter order number">
                  <button type="submit" class="btn btn-theme bg-navy-blue mb-2 ml-3">Check Now <i class="icofont-rounded-right"></i></button>
                </form>
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
                  We are always ready to be of your great service 
                </div>
              </div>
              <div class="col-sm-auto">
                <a href="#" class="btn-theme bg-white light">Get In Touch <i class="icofont-rounded-right"></i></a>
              </div>
          </div>
        </div>
      </section>
      <!-- Client Testimonials End -->
    @push('scripts')
    {{-- <scriptasas defer type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api')}}&sensor=false&libraries=places"></scriptas> --}}


        <script>
          $(function(){
            $('#amountCont').hide();
            $('#type').change(function() {
              let type = $(this).val();
              let distance = $('#distance').val();
              distance = parseFloat(distance);
              let amount = expressDelievery(distance);
              $('#amountCont').show();
              $('#amount').show().val(amount[type]);

            })
          })
          function expressDelievery(distance) {
            
            if (distance < 10) {
              return {
                regular:1000,
                express: 2000
              }
            }
            if (distance < 20) {
              return {
                regular:1500,
                express: 2500
              }
            }
            if (distance < 30) {
              return {
                regular:2000,
                express: 3500
              }
            }
            if (distance < 40) {
              return {
                regular:2500,
                express: 4500
              }
            }
            if (distance < 50) {
              return {
                regular:3000,
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


{{-- </head>
<body>
    <br>
    Basic example for using the Distance Matrix.<br><br>
    Origin: <input id="orig" type="text" style="width:35em"><br><br>
    Destination: <input id="dest" type="text" style="width:35em"><br><br>
    Distance: <input id="dist" type="text" style="width:35em">
</body>
</html> --}}