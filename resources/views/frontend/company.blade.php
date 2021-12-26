@extends('layouts.frontend')
@push('css')
<style type="text/css">
    #line {
        /* position: absolute; */
        /* top: 42px;
                                left: 112px; */
        width: 20%;
        height: 5px;
        background: #ACCF5B;
    }

    .icon-box-5 {
        width: 4rem;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .boxe {
        margin-bottom: 1rem
    }

    .counter-style-1 i {
        font-size: 1.5rem;
    }

    .center-head span {
        display: inline-block;
        padding: 0 20px;
        position: relative;
        z-index: 99;
        font-weight: 600;
    }
</style>
@endpush
@section('content')
<!-- Free Quote Start -->
<section class="bg-white wide-tb-100 mb-spacer-md">
    <div class="container">
        <!-- Heading Main -->
        <div class="col-sm-12">
            <h1 class="heading-main">
                {{-- <span>Book </span> --}}
                @if ($company->logo)
                <span><img style="width:50px;height:50px;border-radius:25px" src="{{Storage::url($company->logo)}}"
                        alt="logo" /></span>
                @endif
                {{$company->company_name}} Logistics Company
            </h1>
        </div>
        <!-- Heading Main -->
        <div class="row">
            <!-- Counter Col Start -->
            @forelse ($company->dailyRoute() as $route)
            <div class="col col-12 col-lg-12 col-sm-12 counter-style-1 light-bg">
                <h5 class="txt-orange text-center mb-5">{{$route->company->company_name}}</h5>
                <div class="light-bg d-flex align-items-center justify-content-around">
                    @foreach ($route->directions as $direction)
                    <div class="boxe">
                        <div class="service-icon mx-auto mb-5 icon-box-5 circle">
                            <i class="icofont-google-map"></i>
                        </div>
                        <div>
                            {{$direction->name}}
                        </div>
                    </div>
                    @if(!$loop->last)
                    <ul class="list-unstyled icons-listing theme-dark mb-0">
                        <li><i class="icofont-double-right"></i></li>
                    </ul>

                    @endif
                    @endforeach

                </div>
                <div class="row d-flex align-self-start ml-5 media-body ">
                    <div>
                        <div><i class="icofont-clock-time mr-3"></i>Departure : {{$route->departure}} Am </div>
                        <div style="position: absolute;"><i class="icofont-whatsapp"></i> <strong class="ml-2">Phone :
                            </strong><a href="">{{$route->company->company_phone}}</a> </div>
                    </div>
                </div>
                {{-- <a href="#" role="button" data-toggle="modal" data-target="#request_company{{$route->company->id}}"
                    class="mr-2 mb-3 btn-theme bg-orange"> Book Now</a> --}}
                <!-- Request Modal -->
                <div class="modal fade" id="request_company{{$route->company->id}}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered request_popup" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <!-- Contact Details Start -->
                                <section class="pos-rel bg-light-gray">
                                    <div class="container-fluid p-0">
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="icofont-close-line"></i>
                                        </a>
                                        <div class="d-lg-flex justify-content-end no-gutters mb-spacer-md"
                                            style="box-shadow: 0px 18px 76px 0px rgba(0, 0, 0, 0.06);">
                                            <div class="col bg-fixed bg-img-7 request_pag_img">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-7 col-12">
                                                <div class="px-3 m-5">
                                                    <h2 class="h2-xl mb-4 fw-6">Book A Rider</h2>
                                                    <form action="{{route('make.request', [$route->id])}}" method="post"
                                                        novalidate="novalidate" class="rounded-field"
                                                        id="request-form-{{$route->id}}">
                                                        @csrf

                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <input value="" oninput="handlePlaces(this.id)" required
                                                                    type="text" name="pickup"
                                                                    class="form-control txtPlaces"
                                                                    placeholder="Pickup Full Address"
                                                                    id="pickup-{{$route->id}}">
                                                                <div class="form-row mb-1">
                                                                    <label rel="more-pickup"
                                                                        class='d-flex justify-content-between more'>
                                                                        <input type="checkbox" rel="more-pickup"><small
                                                                            class="ml-3 more"
                                                                            rel="more-pickup"><strong>Provide more
                                                                                information on pickup location
                                                                                ?</strong></small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <input value="" required type="text" name="delievery"
                                                                    oninput="handlePlaces(this.id)"
                                                                    class="form-control txtPlaces"
                                                                    placeholder="Delivery Full Address"
                                                                    id="delievery-{{$route->id}}">
                                                            </div>

                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col-12 mb-4">
                                                                <input type="text" name="distance" readonly
                                                                    class="form-control" id="distance"
                                                                    placeholder="Distance">
                                                            </div>
                                                            <div class="col-12 mb-4">
                                                                <div class="d-flex">
                                                                    <label>Delivery Type</label><br>

                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between w-50 align-items-center">
                                                                    <label class="mr-2 pr-1" for="regular"><input
                                                                            required id="regular" rel='{{$route->id}}'
                                                                            type="radio" name="type" value="regular"
                                                                            class="type" />Regular (sameday delivery) </label>
                                                                    <label for="express"><input id="express"
                                                                            class='type' rel='{{$route->id}}'
                                                                            type="radio" name="type"
                                                                            value="express" />Express (instant delivery) </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-4" id="amountCont">
                                                                <div class="col-12 mb-4">
                                                                    <input type="text" required name="amount" readOnly
                                                                        class="form-control" id="amount-{{$route->id}}"
                                                                        placeholder="Amount">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <input required type="text" name="recieverName"
                                                                    class="form-control" placeholder="Reciever Name">
                                                            </div>
                                                            <div class="col">
                                                                <input required type="text" name="recieverPhone"
                                                                    class="form-control" placeholder="Reciever Phone">
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <label class="control-label">Payment By ?</label>
                                                                <label for="sender">
                                                                    <input id="sender" required value="sender" checked
                                                                        type="radio" name="payment">
                                                                    Sender
                                                                </label>
                                                                <label for="receiver">
                                                                    <input id="receiver" required value="receiver"
                                                                        type="radio" name="payment">
                                                                    Receiver
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <label>Item Description</label>
                                                                <textarea rows="7" name="description"
                                                                    class="form-control"
                                                                    placeholder="Item Description"></textarea>
                                                            </div>
                                                            <div class="col">
                                                                <label>Delivery Note</label>
                                                                <textarea rows="7" placeholder="Delievery Note"
                                                                    class="form-control" name="note"></textarea>
                                                            </div>

                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="center-head">
                                                                    <p class="bg-light-gray txt-orange">Sender
                                                                        Details</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <input required value="{{request()->name}}" type="text"
                                                                    name="name" class="form-control mb-3"
                                                                    placeholder="Your Name">
                                                                <input required value="{{request()->email}}"
                                                                    type="email" name="email" class="form-control mb-3"
                                                                    placeholder="Email">
                                                                <input required value="{{request()->phone}}" type="text"
                                                                    name="phone" class="form-control"
                                                                    placeholder="Phone Number">
                                                            </div>


                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col pt-3">
                                                                <button type="submit"
                                                                    class="form-btn btn-theme bg-orange">Send Request <i
                                                                        class="icofont-rounded-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Contact Details End -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Request Modal -->
            </div>
            @empty
            <div class="col col-12">
                <h3 class="text-center">Hi There is currently no route attached to this company</h3>
                <p class="txt-blue text-center mt-5">Click the button below to make a request</p>
                <div class="d-flex align-items-center justify-content-center mt-5">

                </div>
            </div>
            @endforelse


            <!-- Counter Col End -->
            <!-- Spacer For Medium -->
            <div class="w-100 d-none d-sm-block  spacer-60"></div>
            <!-- Counter Col Start -->

            <!-- Counter Col End -->
            <!-- Spacer For Medium -->
            <div class="w-100 d-none d-sm-block  spacer-60"></div>
        </div>
        <div class="row">
            <!-- Right Text Start -->
            {{-- <div class="col-md-6 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0s">

            </div> --}}

            <div class="col-lg-4 wow fadeInRight" data-wow-duration="0" data-wow-delay="0.2s">
                {{-- <h3 class="mb-4 fw-7 txt-blue">
                    <span class="fw-6 txt-orange">{{$company->company_name}}</span>
                </h3> --}}
                <div class="align-self-stretch h-100 align-items-center d-flex bg-with-text">
                    <div class="overlay d-flex justify-content-center align-items-center"
                        style="position:absolute; background-color:#252628e6;">
                        {{$company->slogan}}
                    </div>
                </div>
            </div>
            <!-- Right Text Start -->
            <!-- Spacer For Medium -->
            <div class="w-100 d-none d-sm-block d-lg-none spacer-60"></div>
            <!-- Spacer For Medium -->

            <div class="col-lg-8 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0.2s">
                <!-- Free Quote From -->
                @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif

                <form id="request-form-0" action="{{route('send.request')}}" method="post" novalidate="novalidate"
                    class="rounded-field">
                    @csrf

                    <div class="form-row mb-4">
                        <div class="col-12">
                            <input type="hidden" name="companyId" value="{{$company->id}}" />
                            <input type="hidden" name="lng" class="pickup-lng" value="" />
                            <input type="hidden" name="lat" class="pickup-lat" value="" />

                            <input value="{{old('pickup')}}" required type="text" name="pickup" id="pickup"
                                class="form-control" placeholder="Pickup Full Address">
                            <div class="form-row mb-1">
                                <label rel="more-pickup" class='d-flex justify-content-between more'>
                                    <input type="checkbox" rel="more-pickup"><small class="ml-3 more"
                                        rel="more-pickup"><strong>Provide more information on pickup location?(optional)
                                        </strong></small>
                                </label>
                                <div class="col-12  more-details my-md-2" id="more-pickup">
                                    <input type="text" name="morePickup" class="form-control col-12"
                                        placeholder="more details for pickup">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <input value="{{old('delievery')}}" required type="text" name="delievery" id="destination"
                                class="form-control" placeholder="Delivery Full Address">
                            <div class="form-row ">
                                <label rel="more-destination" class='d-flex justify-content-between more'>
                                    <input type="checkbox" rel="more-destination"><small class="ml-3 more"
                                        rel="more-destination"><strong>Provide more information on Delivery location
                                            ?(optional)</strong></small>
                                </label>
                            </div>
                            <div class="col-12 mb-4 more-details mt-lg-1" id="more-destination">
                                <input type="text" name="moreDestination" class="form-control"
                                    placeholder="more details delivery location">
                            </div>
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col-12 mb-4">
                            <input type="text" value="{{old('distance')}}" readonly name="distance" class="form-control" id="distance"
                                placeholder="Distance">
                        </div>
                        <div class="col-12 mb-4">
                            <div class="d-flex">
                                <label>Delivery Type</label><br>
                                 
                                
                            </div>
                            <div class="d-flex justify-content-between w-50 align-items-center">
                                <label class="mr-2 pr-1" for="regular-0">
                                    <input id="regular-0" rel="0" type="radio" name="type" value="regular"
                                        class='type' />Regular (sameday delivery)
                                </label>
                                <label for="express-0">
                                    <input id="express-0" class='type' rel="0" type="radio" name="type"
                                        value="express" />Express (instant delivery) </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-row mb-4" id="amountCont">
                        <div class="col-12 mb-4">
                            <input type="text" name="amount" readOnly class="form-control" id="amount"
                                placeholder="Amount" value="{{old('amount')}}">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col">
                            <input required type="text" name="recieverName" class="form-control"
                                placeholder="Reciever Name">
                        </div>
                        <div class="col">
                            <input required type="text" name="recieverPhone" class="form-control"
                                placeholder="Reciever Phone">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col">
                            <label class="control-label">Payment By ?</label>
                            <label for="sender">
                                <input id="sender" required value="sender" checked type="radio" name="payment">
                                Sender
                            </label>
                            <label for="receiver">
                                <input id="receiver" required value="receiver" type="radio" name="payment">
                                Receiver
                            </label>

                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <textarea rows="5" name="description" class="form-control"
                                placeholder="Item Description"></textarea>
                        </div>

                        <div class="col">
                            <textarea rows="5" placeholder="Delievery Note" class="form-control" name="note"></textarea>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="center-head">
                                <p class="bg-light-gray txt-orange">Sender
                                    Details</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col">
                            <input required value="{{old('name')}}" type="text" name="name" class="form-control mb-3"
                                placeholder="Your Name">
                            <input required value="{{old('email')}}" type="email" name="email" class="form-control mb-3"
                                placeholder="Email">
                            <input required value="{{old('phone')}}" type="text" name="phone" class="form-control"
                                placeholder="Phone Number">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col pt-3">
                            <button type="submit" class="form-btn btn-theme bg-orange">Send Request <i
                                    class="icofont-rounded-right"></i></button>
                        </div>
                    </div>
                </form>
                <!-- Free Quote From -->
            </div>

        </div>
    </div>
</section>
<!-- Free Quote End -->
@push('scripts')

{{-- <script src="{{asset('assets/js/script.js')}}"></script> --}}
<script>
    // $(function(){
    //     initGooglePlaces(['pickup', 'destination']);
    // })
    $(function(){
        $('.more-details').hide();
        $('.more').click(function(){
            let id = $(this).attr('rel');
            $(`#${id}`).toggle();
        })
    })

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
            // alert(amount[type])
            $(`#request-form-${id} #amountCont`).show();
            // $(`#request-form-${id} #amount`).show().val(amount);
            let idSelected = `#request-form-${id} #amount`;
            let amount = expressDelievery(distance, type, idSelected);

        }
    }
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
                // console.log(status);
            //   let dist = document.getElementById("distance");
              let dist = document.querySelector("#request-form-0 #distance");
              if(status=="OK") {             
                  dist.value = response.rows[0].elements[0].distance.text;
              } else {
                  alert("Error: " + status);
              }
            }
  </script>
@endpush
@endsection