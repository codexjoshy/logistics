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
<section class="wide-tb-100 pb-0 mb-spacer-md">
    <div class="container">
        @if ($routes && count($routes))
            <div class="row">
                <div class="col-sm-12 d-flex">
                    <h3 class="h3-sm fw-6 txt-blue mb-4 col-md-6">Directions</h3>
                    <p>
                        Didn't find any what you're looking for ?  
                        <a href="#" role="button" data-toggle="modal" data-target="#request_popup"
                            class="mr-2 mb-3 btn-theme bg-orange"> Make Request</a>
                    </p>
                </div>

            </div>
        @endif
        <div class="row">
            <!-- Counter Col Start -->
            @forelse ($routes as $route)
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
                        <div style="position: absolute;" ><i class="icofont-whatsapp"></i> <strong class="ml-2">Phone :  </strong><a href="">{{$route->company->company_phone}}</a> </div>
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
                                                        class="rounded-field" id="request-form-{{$route->id}}">
                                                        @csrf

                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <input readonly  value="{{request()->pickup}}" required type="text" name="pickup" id="pickup-{{$route->id}}"
                                                                    class="form-control" placeholder="Pickup Full Address" >
                                                                @if (request()->morePickup)
                                                                <div class="col-12 mb-4 more-details mt-lg-1" id="more-destination">
                                                                    <input readOnly value="{{request()->morePickup}}" type="text" name="morePickup" class="form-control"
                                                                        placeholder="more details delivery location">
                                                                </div>
                                                                    
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <input readonly value="{{request()->destination}}" required type="text" name="delievery" id="delievery-{{$route->id}}"
                                                                    class="form-control" placeholder="Delivery Full Address">
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
                                                              <input type="text" name="distance" readonly class="form-control" id="distance" placeholder="Distance">
                                                            </div>
                                                            <div class="col-12 mb-4">
                                                                <div class="d-flex">
                                                                    <label >Delivery Type</label><br>

                                                                </div>
                                                                <div class="d-flex justify-content-between w-50 align-items-center">
                                                                    <label class="mr-2 pr-1" for="regular"><input required id="regular" rel='{{$route->id}}'  type="radio" name="type" value="regular" class="type" />Regular </label>
                                                                    <label  for="express"><input id="express" class='type' rel='{{$route->id}}' type="radio" name="type" value="express" />Express </label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="form-row mb-4" id="amountCont">
                                                            <div class="col-12 mb-4">
                                                                <input type="text" required name="amount" readOnly class="form-control" id="amount" placeholder="Amount">
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
                                                                <label>Item Description</label>
                                                                <textarea rows="5" name="description" class="form-control"
                                                                    placeholder="Item Description"></textarea>
                                                            </div>
                                                            <div class="col">
                                                                <label>Delivery Note </label>
                                                                <textarea rows="7" placeholder="Delievery Note" class="form-control" name="note"></textarea>
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
                <h3 class="text-center">Hi {{request()->name}} We were unable to find a dispatcher for you that goes through your routes at this time.</h3>
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
    </div>
    @push('scripts')
        <script  src="{{asset('assets/js/script.js')}}"> </script>

    @endpush

</section>


@endsection