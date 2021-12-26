@extends('layouts.frontend')
@push('css')

@endpush
@section('content')
<!-- Contact Details Start -->
<section class="wide-tb-100 pos-rel">
    <div class="container">
      <div class="contact-map-bg option">
        <img src="assets/images/map-bg.png" alt="">
      </div>

      <div class="row">
        <div class="col-md-4">
          <h2 class="h2-md mb-4 fw-7 txt-blue">Our Details</h2>
          <!-- Contact Detail Left -->
          <div class="contact-detail-shadow no-shadow mb-5 wow fadeInRight" data-wow-duration="0" data-wow-delay="0s">
            <h4>Nigeria</h4>
            <div class="d-flex align-items-start items">
              <i class="icofont-google-map"></i> <span>Ikeja Lagos.</span>
            </div>
            <div class="d-flex align-items-start items">
              <i class="icofont-phone"></i> <span><a href="tel:+2348175009200">+234 (0) 817 500 9200</a> </span>
            </div>
            <div class="text-nowrap d-flex align-items-start items">
              <i class="icofont-email"></i> <a target="_blank"href="mailto:support@booklogistic.com">support@booklogistic.com</a>
            </div>
            <div class="text-nowrap d-flex align-items-start items">
                <i class="icofont-whatsapp"></i> <a target="_blank" href="https://wa.me/message/WBXVFFUUUMIZJ1">+234 (0) 817 500 9200</a> 
            </div>
            <div class="text-nowrap d-flex align-items-start items">
                <i class="icofont-facebook"></i><a target="_blank" href="https://m.facebook.com/booklogistic-202950091754381/">booklogistic</a> 
            </div>
          </div>
          <!-- Contact Detail Left -->

        </div>


        <div class="col-md-8 col-sm-12">
          <h2 class="h2-md mb-4 fw-7 txt-blue">Say Hello! Its Free</h2>
          <div class="">
        
            <div class="free-quote-form contact-page-option wow fadeInLeft" data-wow-duration="0" data-wow-delay="0s">                  
                <form action="{{route('frontend.contact.process')}}" method="post" id="contactoption" novalidate="novalidate" class="rounded-field">
                    @csrf
                    <div class="form-row mb-4">
                      <div class="col">
                        <input required type="text" name="name" class="form-control" placeholder="Your Name">
                      </div>
                      <div class="col">
                        <input required type="text" name="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="col">
                        <input required type="text" name="phone" class="form-control" placeholder="Phone">
                      </div>
                    </div>
                    
                    <div class="form-row mb-4">
                      <div class="col">
                        <textarea required name="message" rows="7" placeholder="Message" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-row text-center">

                        <button name="contactoption" id="contactoption" type="submit" class="form-btn mx-auto btn-theme bg-orange">Submit Now <i class="icofont-rounded-right"></i></button>
                    </div>
                </form>                
            </div>
            
            </div>
        </div>
      </div>
    </div>        
  </section>
  <!-- Contact Details End -->  


@endsection