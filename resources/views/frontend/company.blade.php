@extends('layouts.frontend')

@section('content')
<!-- Free Quote Start -->
<section class="bg-white wide-tb-100 mb-spacer-md">
    <div class="container">          
      <!-- Heading Main -->
      <div class="col-sm-12">
        <h1 class="heading-main">
          {{-- <span>Book  </span> --}}
          @if ($company->logo)
              <span><img style="width:50px;height:50px;border-radius:25px" src="{{Storage::url($company->logo)}}" alt="logo" /></span>
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
                    <div><i class="icofont-whatsapp"></i> <strong class="ml-2">Phone :  </strong><a href="">{{$route->company->company_phone}}</a> </div>
                </div>
            </div>
            <a href="#" role="button" data-toggle="modal" data-target="#request_company{{$route->company->id}}"
                class="mr-2 mb-3 btn-theme bg-orange"> Book Now</a>
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
                                          <form action="{{route('make.request', [$route->id])}}" method="post" novalidate="novalidate"
                                              class="rounded-field">
                                              @csrf

                                              <div class="form-row mb-4">
                                                  <div class="col">
                                                      <input value="" required type="text" name="pickup"
                                                          class="form-control" placeholder="Pickup Full Address">
                                                  </div>
                                                  <div class="col">
                                                      <input value="" required type="text" name="delievery"
                                                          class="form-control" placeholder="Delivery Full Address">
                                                  </div>
                                                  
                                              </div>
                                              <div class="form-row mb-4">
                                                  <div class="col">
                                                      <input  required type="text" name="recieverName"
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
                                                          <input id="sender" required value="sender" checked type="radio" name="payment">
                                                          Sender
                                                      </label>
                                                      <label for="receiver">
                                                          <input id="receiver" required value="receiver"  type="radio" name="payment">
                                                          Receiver
                                                      </label>
                                                      
                                                  </div>
                                              </div>
                                              
                                              <div class="form-row mb-4">
                                                  <div class="col">
                                                      <textarea rows="5" name="description" class="form-control"
                                                          placeholder="Item Description"></textarea>
                                                  </div>

                                              </div>

                                              <div class="form-row">
                                                  <div class="col">
                                                      <div class="center-head"><p
                                                              class="bg-light-gray txt-orange">Your Personal
                                                              Details</p></div>
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
                                                  
                                                  <div class="col">
                                                      <textarea rows="7" placeholder="Delievery Note" class="form-control" name="note"></textarea>
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
            <h3 class="text-center">Hi  We were unable to find a dispatcher for you that goes through your routes at this time.</h3>
            <p class="txt-blue text-center mt-5">Click the button below to make a request</p>
            <div class="d-flex align-items-center justify-content-center mt-5">
                <a href="#" role="button" data-toggle="modal" data-target="#request_popup"
                    class="mr-2 mb-3 btn-theme bg-orange"> Request Now</a>
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
                Whether you require distribution or fulfillment, defined freight forwarding, or a complete supply chain solution, we are here for you.
            </div>
          </div>
          <!-- Right Text Start -->

          <!-- Spacer For Medium -->
          <div class="w-100 d-none d-sm-block d-lg-none spacer-60"></div>
          <!-- Spacer For Medium -->

          <div class="col-lg-8 wow fadeInLeft" data-wow-duration="0" data-wow-delay="0.2s">
            <!-- Free Quote From -->
            <form action="{{route('send.request')}}" method="post" novalidate="novalidate" class="rounded-field gray-field">
              @csrf  
                <div class="form-row mb-4">
                  <div class="col">
                    <input type="hidden" value="{{$company->id}}" name="companyId" />
                    <input type="text" value="{{old('pickup')}}" name="pickup" class="form-control" placeholder="Your Pickup Address">
                  </div>
                  <div class="col">
                    <input type="text" value="{{old('delievery')}}" name="delievery" class="form-control" placeholder="Your Delievery Address">
                  </div>
                  {{-- <div class="col">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                  </div> --}}
                </div>
                <div class="form-row mb-4">
                  <div class="col">
                    <input type="text" value="{{old('recieverName')}}" name="recieverName" class="form-control" placeholder="Reciever Name">
                  </div>
                  <div class="col">
                    <input type="text" value="{{old('recieverPhone')}}" name="recieverPhone" class="form-control" placeholder="Reciever Phone">
                  </div>
                  
                  {{-- <div class="col">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                  </div> --}}
                </div>
                <div class="form-row mb-4">
                  <div class="col">
                    <label class="control-label">Payment By ?</label>
                    <label for="sender">
                      <input id="sender" required value="sender" checked type="radio" name="payment">
                        Sender
                    </label>
                    <label for="receiver">
                      <input id="receiver" required value="receiver"  type="radio" name="payment">
                        Receiver
                    </label>
                      
                  </div>
              </div>
                <div class="form-row mb-4">
                  <div class="col">
                    <textarea rows="7" placeholder="Item Description" name="description"  class="form-control"></textarea>
                  </div>
                  <div class="col">
                    <textarea rows="7" placeholder="Delievery Note" name="note" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="center-head"><span class="bg-light-gray txt-orange">Your Personal Details</span></div>
                  </div>
                </div>

                <div class="form-row mb-4">
                  <div class="col">
                    <input required value="{{old('name')}}" type="text" name="name" class="form-control mb-3" placeholder="Your Name">
                    <input required value="{{old('email')}}" type="email" name="email" class="form-control mb-3" placeholder="Email">
                    <input required value="{{old('phone')}}" type="text" name="phone" class="form-control" placeholder="Phone Number">
                  </div>
                  
                </div>
            
                
                <div class="form-row text-center">
                    <button type="submit" class="form-btn mx-auto btn-theme bg-orange">Make Request <i class="icofont-rounded-right"></i></button>
                </div>
            </form>
            <!-- Free Quote From -->
          </div>
          
      </div>
    </div>
  </section>
  <!-- Free Quote End -->

@endsection