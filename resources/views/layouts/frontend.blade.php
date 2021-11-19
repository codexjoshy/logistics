<!doctype html>
<html lang="en">
<head>
  <!-- xxx Basics xxx -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- xxx Change With Your Information xxx -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
  <title>BOOK LOGISTIC</title>
  <meta name="author" content="Mannat Studio">
  <meta name="description" content="Book Logistic,is a platform that connects logistic companies with customers in need to deliver items">
  <meta name="keywords"
    content="Logistic, logistic, deliver, bike delivery">

  <!-- xxx Favicon xxx -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/frontenc/favicon.ico') }}">

  <!-- xxx Favicon xxx -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/frontend/favicon.ico') }}">

  <!-- xxx Favicon xxx -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/frontend/favicon.ico') }}">

  <!-- Main Style CSSS -->
  <link href="{{ asset('assets/css/theme-plugins.min.css') }}" rel="stylesheet">
  <!-- Main Theme CSS -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <!-- Responsive Theme CSS -->
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

  <!-- REVOLUTION NAVIGATION STYLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/layers.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/navigation.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/settings.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('assets/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('assets/revolution/fonts/font-awesome/css/font-awesome.css') }}">
  <style>
    .navbar-brand {
      background-color: transparent !important;
    }
    .bg-with-text {
      background-image: url('{{asset('assets/map.jpg')}}') !important;
      background-position: center !important;
      background-color:'#000';
      background-size: cover;
      border-radius: 5px;
      text-align: center;
      color: #FFF;
      font-size: 1.125rem;
      padding: 0 1.5rem;
      font-weight: 300;
      line-height: 2;
    }
  </style>
  @stack('css')
</head>

<body>

  <header class="header-three wow fadeInDown">
    <!-- Main Navigation Start -->
    <nav class="navbar navbar-expand-lg header-fullpage">
      <div class="container d-flex align-items-start">
        <div class="col col-lg-2 col-md-3">
          <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/frontend/logo.png') }}" alt="logo.png" style="width:60%;" />
          </a>
        </div>
        <!-- Toggle Button Start -->
        <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Toggle Button End -->
        <div class="col-lg-auto">
          <div class="text-right top-bar">
            <!-- Topbar Social Icons Start -->
            <div class="top-bar-btn d-inline-flex social-icons">
              <a target="_blank" href="https://m.facebook.com/booklogistic-202950091754381/"><i class="icofont-facebook"></i></a>
              {{-- <a href="#"><i class="icofont-twitter"></i></a> --}}
              <a target="_blank" href="https://wa.me/message/WBXVFFUUUMIZJ1"><i class="icofont-whatsapp"></i></a>
              <a target="_blank" href="mailto:support@booklogistic.com"><i class="icofont-google-plus"></i></a>
            </div>
            <!-- Topbar Social Icons End -->

            <!-- Topbar Request Quote Start -->
            <div class="top-bar-btn d-inline-flex request-btn">
              {{-- <a class="btn-theme icon-left bg-orange" href="#" role="button" data-toggle="modal" data-target="#request_popup"><i class="icofont-page"></i> Request Quote</a> --}}
            </div>
            <!-- Topbar Request Quote End -->
          </div>
          <div class="collapse navbar-collapse nav-light" id="navbarCollapse" data-hover="dropdown"
            data-animations="slideInUp slideInUp slideInUp slideInUp">
            <div class="ml-auto">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('frontend.index') }}" aria-haspopup="true"
                    aria-expanded="false">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('frontend.contact') }}" aria-haspopup="true"
                    aria-expanded="false">Contact </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#track" aria-haspopup="true"
                    aria-expanded="false">Track Item </a>
                </li>
                @guest
                <li class="nav-item">
                  <a class="nav-link" href="/login" aria-haspopup="true" aria-expanded="false">Login </a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('dashboard') }}" aria-haspopup="true"
                    aria-expanded="false">Dashboard
                  </a>
                </li>
                @endauth



                <li class="nav-item">
                  <a class="nav-link" href="#" id="search_home"><i class="icofont-search"></i></a>
                </li>
              </ul>
              <!-- Main Navigation End -->
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Main Navigation End -->
  </header>
  @yield('slider')
  <main id="body-content">
    @if (session('success'))
    <!-- Message Boxes Start -->
    <section class="wide-tb-100 pb-0">
      <div class="container">
        <div class="row">

          <div class="col-sm-12">
            <div class="alert alert-success" role="alert">
              <p class="text-center d-inline-block">
                <strong>{{ session('success') }}</strong>
              </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @if ($errors->any())

          <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
              <p class="text-center d-inline-block">
                <strong>{{ implode('', $errors->all('<div>:message</div>')) }}</strong>
              </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @endif
        </div>
      </div>
    </section>
    <!-- Message Boxes End -->
    @endif
    @if (session('error'))
    <!-- Message Boxes Start -->
    <section class="wide-tb-100 pb-0">
      <div class="container">
        <div class="row">

          <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
              <p class="text-center d-inline-block">
                <strong>{{ session('error') }}</strong>
              </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @if ($errors->any())

          <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
              <p class="text-center d-inline-block">
                <strong>{{ implode('', $errors->all('<div>:message</div>')) }}</strong>
              </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @endif
        </div>
      </div>
    </section>
    <!-- Message Boxes End -->
    @endif
    {{-- @if (session('error')) --}}
    <!-- Message Boxes Start -->
    @if ($errors->any())
    <section class="wide-tb-100 pb-0">
      <div class="container">
        <div class="row">

          <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
              <p class="text-center d-inline-block">
                <strong>{{ implode('', $errors->all('<div>:message</div>')) }}</strong>
              </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>


          {{-- <div class="col-sm-4">
            <div class="alert alert-danger" role="alert">
              A simple danger alert
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div> --}}
        </div>
      </div>
    </section>
    @endif
    <!-- Message Boxes End -->
    {{-- @endif --}}
    @yield('content')
  </main>

  <!-- Main Footer Start -->
  <footer class="wide-tb-70 bg-light-gray pb-0">
    <div class="container">
      <div class="row">

        <!-- Column First -->
        <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0s">
          <div class="logo-footer">
            <img src="{{ asset('assets/images/frontend/logo.png') }}" alt="">
          </div>
          <p>Lets get to meet you on various social platform</p>
          <p>we are ready to be of assistance</p>

          
          <h3 class="footer-heading">We're Social</h3>
          <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100072326775033"><i class="icofont-facebook"></i></a>
            {{-- <a href="#"><i class="icofont-twitter"></i></a> --}}
            <a href="https://wa.me/message/WBXVFFUUUMIZJ1"><i class="icofont-whatsapp"></i></a>
            <a href="mailto:support@booklogistic.com"><i class="icofont-google-plus"></i></a>
            <a href="https://www.instagram.com/invites/contact/?i=827jpvt7cs7g&utm_content=mjo8noc">
              <i class="icofont-instagram"></i></a>
          </div>
        </div>
        <!-- Column First -->

        <!-- Column Second -->
        {{-- <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0.2s">

        </div> --}}
        <!-- Column Second -->

        <!-- Column Third -->
        <div class="col-lg-4 col-md-12 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0.4s">
          {{-- <h3 class="footer-heading">Our Photostream</h3>
            <ul id="basicuse" class="photo-thumbs"></ul> --}}
        </div>
        <div class="col-lg-4 col-md-12 wow fadeInLeft " data-wow-duration="0" data-wow-delay="0.4s">
          <h3 class="footer-heading">Main Links</h3>
            <ul id="" class="">
              <li><a href="/">Home</a></li>
              <li><a href="{{route('frontend.contact')}}">Contact</a></li>
              <li><a href="{{route('login')}}">Login</a></li>
            </ul>
        </div>
        <!-- Column Third -->

      </div>
    </div>

    <div class="copyright-wrap bg-navy-blue wide-tb-30">
      <div class="container">
        <div class="row text-md-left text-center">
          <div class="col-sm-12 col-md-4 copyright-links">
            <a href="#">Privacy Policy</a> <span>|</span> <a href="{{route('frontend.contact')}}">Contact</a> <span>|</span> <a target="_blank"
              href="{{ route('terms.condition') }}">Terms & Conditions</a>
          </div>
          <div class="col-sm-12 col-md-4 copyright-links text-center">
            <a href="/">Book Logistic</a> 
        </div>
          <div class="col-sm-12 col-md-4 text-md-right text-center">
            Designed by <a href="#" rel="nofollow">Booklogistic</a> © 2021 All Rights Reserved
          </div>
         
        </div>
         
        </div>
      </div>
    </div>
  </footer>
  <!-- Main Footer End -->

  <!-- Request Modal -->
  <div class="modal fade" id="request_popup" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <form action="{{ route('send.request') }}" method="post" novalidate="novalidate"
                      class="rounded-field" id="request-form-0">
                      @csrf
                      @if ($errors->any())

                      <div class="col-sm-12">
                        <div class="alert alert-danger" role="alert">
                          <p class="text-center d-inline-block">
                            <strong>{{ implode('', $errors->all('<div>:message</div>')) }}</strong>
                          </p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>
                      @endif

                      <div class="form-row mb-4">
                        <div class="col-12">
                          <label>Pickup Address</label>
                          <input readonly value="{{ old('pickup') ?? request()->pickup }}" required type="text" name="pickup"
                            class="form-control" placeholder="Pickup Address">
                          @error('pickup')
                          {{ $message }}
                          @enderror
                          @if (request()->morePickup)
                            <div class="col-12 mb-4 more-details mt-lg-1" id="more-destination">
                                <input readOnly value="{{request()->morePickup}}" type="text" name="morePickup" class="form-control"
                                    placeholder="more details delivery location">
                            </div>
                                
                          @endif
                        </div>
                      </div>
                      <div class="form-row mb-4">
                        <div class="col-12">
                          <label>Destination</label>
                          <input readonly value="{{ old('delievery') ?? request()->destination }}" required type="text"
                            name="delievery" class="form-control" placeholder="Delivery Address">
                          @error('delievery')
                          {{ $message }}
                          @enderror

                          @if (request()->moreDestination)
                            <div class="col-12 mb-4 more-details mt-lg-1" id="more-destination">
                                <input readOnly value="{{request()->moreDestination}}" type="text" name="moreDestination" class="form-control"
                                    placeholder="more details delivery location">
                            </div>
                                
                          @endif
                        </div>
                      </div>
                      <div class="form-row mb-4">
                        <div class="col-12 mb-4">
                          <input required type="text" name="distance" readonly value="" class="form-control" id="distance" placeholder="Distance">
                        </div>
                        <div class="col-12 mb-4">
                          <div class="d-flex">
                            <label>Delivery Type</label><br>

                          </div>
                          <div class="d-flex justify-content-between w-50 align-items-center">
                            <label for="regular" class="mr-2 pr-1">
                              <input required id="regular" rel="0"  type="radio" name="type"
                                value="regular" class='type' />Regular </label>

                            <label for="express">
                              <input id="express" rel='0' type="radio" class='type' name="type" value="express" />Express
                            </label>

                          </div>
                        </div>

                      </div>
                      <div class="form-row mb-4" id="amountCont">
                        <div class="col-12 mb-4">
                          <input required type="text" name="amount" readOnly class="form-control" id="amount"
                            placeholder="Amount">
                        </div>
                      </div>
                      <div class="form-row mb-4">
                        <div class="col">
                          <input required value="{{ old('recieverName') }}" type="text" name="recieverName"
                            class="form-control" placeholder="Reciever Name">
                          @error('recieverName')
                          {{ $message }}
                          @enderror
                        </div>
                        <div class="col">
                          <input required value="{{ old('recieverPhone') }}" type="text" name="recieverPhone"
                            class="form-control" placeholder="Reciever Phone">
                          @error('recieverPhone')
                          {{ $message }}
                          @enderror
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
                            <input id="receiver"  value="receiver" type="radio" name="payment">
                            Receiver
                          </label>

                        </div>
                      </div>
                      <div class="form-row mb-4">
                        <div class="col">
                            <label>Item Description</label>
                          <textarea rows="5" placeholder="Item Description" name="description" class="form-control">
                            {{old('description')}}
                              </textarea>
                        </div>
                        <div class="col">
                            <label>Delievery Note</label>
                          <textarea rows="5" placeholder="Delievery Note" class="form-control" name="note">
                            {{old('note')}}
                              </textarea>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <div class="center-head"><span class="bg-light-gray txt-orange">Your Personal
                              Details</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-row mb-4">
                        <div class="col">
                          <input required value="{{ request()->name }}" type="text" name="name"
                            class="form-control mb-3" placeholder="Your Name">
                          <input required value="{{ request()->email }}" type="email" name="email"
                            class="form-control mb-3" placeholder="Email">
                          <input required="required" value="{{ request()->phone }}" type="number" name="phone" class="form-control"
                            placeholder="Phone Number">
                        </div>

                      </div>
                      <div class="form-row">
                        <div class="col pt-3 mb-3">
                          <button type="submit" class="form-btn btn-theme bg-orange"> Request
                            <i class="icofont-rounded-right"></i></button>
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

  <!-- Jquery Library JS -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme-plugins.min.js') }}"></script>
  <script src="{{ asset('assets/twitter/jquery.tweet.js') }}"></script>

  <!-- JQuery Map Plugin -->

  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api') }}&sensor=false&libraries=places">
  </script>

  <script type="text/javascript" src="{{ asset('assets/js/jquery.gmap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <!-- REVOLUTION JS FILES -->
  <script type="text/javascript" src="assets/revolution/js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="assets/revolution/js/jquery.themepunch.revolution.min.js"></script>

  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.actions.min.js') }}">
  </script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.kenburn.min.js') }}">
  </script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
  <script type="text/javascript"
    src="{{ asset('assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/revolution/js/extensions/revolution.extension.video.min.js') }}">
  </script>

  <!-- Theme Custom FIle -->
  <script src="{{ asset('assets/js/site-custom.js') }}"></script>

  <script type="text/javascript">
    var tpj = jQuery;

        var revapi1078;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_1078_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_1078_1");
            } else {
                revapi1078 = tpj("#rev_slider_1078_1").show().revolution({
                    sliderType: "standard"
                    , jsFileLocation: "revolution/js/"
                    , sliderLayout: "fullscreen"
                    , dottedOverlay: "none"
                    , delay: 9000
                    , navigation: {
                        keyboardNavigation: "off"
                        , keyboard_direction: "horizontal"
                        , mouseScrollNavigation: "off"
                        , mouseScrollReverse: "default"
                        , onHoverStop: "off"
                        , touch: {
                            touchenabled: "on"
                            , swipe_threshold: 75
                            , swipe_min_touches: 1
                            , swipe_direction: "horizontal"
                            , drag_block_vertical: false
                        }
                        , arrows: {
                            style: "metis"
                            , enable: true
                            , hide_onmobile: true
                            , hide_under: 600
                            , hide_onleave: true
                            , hide_delay: 200
                            , hide_delay_mobile: 1200
                            , left: {
                                h_align: "left"
                                , v_align: "center"
                                , h_offset: 30
                                , v_offset: 0
                            }
                            , right: {
                                h_align: "right"
                                , v_align: "center"
                                , h_offset: 30
                                , v_offset: 0
                            }
                        }
                        , bullets: {
                            style: 'hades'
                            , tmp: '<span class="tp-bullet-image"></span>'
                            , enable: false
                            , hide_onmobile: true
                            , hide_under: 600,
                            //style:"metis",
                            hide_onleave: true
                            , hide_delay: 200
                            , hide_delay_mobile: 1200
                            , direction: "horizontal"
                            , h_align: "center"
                            , v_align: "bottom"
                            , h_offset: 0
                            , v_offset: 30
                            , space: 5
                        , }
                    }
                    , viewPort: {
                        enable: true
                        , outof: "pause"
                        , visible_area: "80%"
                        , presize: false
                    }
                    , responsiveLevels: [1240, 1024, 778, 480]
                    , visibilityLevels: [1240, 1024, 778, 480]
                    , gridwidth: [1240, 1024, 778, 480]
                    , gridheight: [600, 600, 500, 400]
                    , lazyType: "none"
                    , parallax: {
                        type: "mouse"
                        , origo: "slidercenter"
                        , speed: 2000
                        , levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 47, 48, 49, 50, 51, 55]
                        , type: "mouse"
                    , }
                    , shadow: 0
                    , spinner: 'spinner2'
                    , stopLoop: "off"
                    , stopAfterLoops: -1
                    , stopAtSlide: -1
                    , shuffle: "off"
                    , autoHeight: "off"
                    , hideThumbsOnMobile: "off"
                    , hideSliderAtLimit: 0
                    , hideCaptionAtLimit: 0
                    , hideAllCaptionAtLilmit: 0
                    , debugMode: false
                    , fallbacks: {
                        simplifyAll: "off"
                        , nextSlideOnWindowFocus: "off"
                        , disableFocusListener: false
                    , }
                });
            }
        }); /*ready*/

  </script>
  <script>
    $(function() {
      function calculateDelieveryDistance(lat, lng, destination) {
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
          callToAction
        );
      }
      function callToAction(response, status) {
        let dist = document.querySelector("#request-form-0 #distance");
        if(status=="OK") {             
            dist.value = response.rows[0].elements[0].distance.text;
        } else {
            alert("Error: " + status);
        }
      }
      let longitude = "{{request()->lng}}";
      let latitude = "{{request()->lat}}";
      let destination = "{{request()->destination}}";
      if (longitude && latitude && destination) {
        calculateDelieveryDistance(latitude, longitude, destination);
      }
    })

    //  $(function(){
    //     $('#amountCont').hide();
    //     $('.type').change(function() {
    //       let type = $(this).val();
    //       let distance = $('#distance').val();
    //       distance = parseFloat(distance);
    //       if (distance) {
    //         let amount = expressDelievery(distance);
    //         $('#amountCont').show();
    //         $('#amount').show().val(amount[type]);
    //       }

    //     })
    //     function expressDelievery(distance) {
            
    //       if (distance < 10) {
    //         return {
    //           regular:1000,
    //           express: 2000
    //         }
    //       }
    //       if (distance < 20) {
    //         return {
    //           regular:1500,
    //           express: 2500
    //         }
    //       }
    //       if (distance < 30) {
    //         return {
    //           regular:2000,
    //           express: 3500
    //         }
    //       }
    //       if (distance < 40) {
    //         return {
    //           regular:2500,
    //           express: 4500
    //         }
    //       }
    //       if (distance < 50) {
    //         return {
    //           regular:3000,
    //           express: 5500
    //         }
    //       }
    //     }
    //   })
  </script>
  @stack('scripts')
</body>

</html>