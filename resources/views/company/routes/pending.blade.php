@extends('layouts.dashboard')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        @php
            $company= auth()->user()->company;
        @endphp
        <x-base.card title="Customer Request Information">
            @php
            // $direction = $dailyRoute->directions->pluck('name')->toArray();
            // $requests = $services->placeRequest($dailyRoute->id);
            $user = auth()->user();
            $balance = $user->balance();
            $canView = !$user->isOwing() && $placeRequest->hasEnoughBalance($balance);

            @endphp
            <x-slot name="action">
            @if (!$canView)
                <p class="text-danger"><small>Sorry, you do not have enough funds to view the customer request. </small> 
                    <a href="{{route('company.wallet')}}" class='btn btn-sm btn-success'>Fund Wallet</a></p>
            @else
            <span>This customer requires your service. Kindly reach out with the following information bellow</span>
            @endif
            </x-slot>
          
            {{-- <x-base.form :action="route('company.riders.store', $company->id)" autocomplete="off"> --}}
           
                <div class="form-row">
                    <x-base.form-group label="Customer Name" required class="col-md-4">
                        <x-base.input disabled required :value="$canView? $placeRequest->customer->name : '' " name="rider_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Customer Email" required class="col-md-4">
                        <x-base.input disabled required :value="$canView? $placeRequest->customer->email : '' " name="rider_email" />
                    </x-base.form-group>
                    <x-base.form-group label="Customer Phone Number" required class="col-md-4">
                        <x-base.input disabled required :value="$canView? $placeRequest->customer->phone : '' " name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Pickup Address" required class="col-md-12">
                        <x-base.input disabled required :value="$placeRequest->pickup_address  " name="pickup_address" />
                    </x-base.form-group>
                    <x-base.form-group label="More details on Pickup Address" required class="col-md-12">
                        <x-base.input disabled required :value="$placeRequest->pickup_more_details" name="pickup_more_details" />
                    </x-base.form-group>
                    <x-base.form-group label="Delievery Address" required class="col-md-12">
                        <x-base.input disabled required :value="$placeRequest->delievery_address " name="delievery_address" />
                    </x-base.form-group>
                    
                    <x-base.form-group label="More Details on Delievery Address" required class="col-md-12">
                        <x-base.input disabled required :value="$placeRequest->destination_more_details" name="destination_more_details" />
                    </x-base.form-group>
                    <x-base.form-group label="Reciever Name" required class="col-md-4">
                        <x-base.input disabled required :value="$canView ? $placeRequest->reciever_name : '' " name="rider_name"/>
                    </x-base.form-group>
                    
                    <x-base.form-group label="Reciever Phone Number" required class="col-md-4">
                        <x-base.input disabled required :value="$canView ? $placeRequest->reciever_phone : '' " name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Distance" required class="col-md-4">
                        <x-base.input disabled required :value="$canView ? $placeRequest->distance : '' " name="distance" />
                    </x-base.form-group>
                    <x-base.form-group label="Delivery Type" required class="col-md-4">
                        <x-base.input disabled required :value="$canView ? $placeRequest->type : '' " name="type" />
                    </x-base.form-group>
                    <x-base.form-group label="Amount" required class="col-md-4">
                        <x-base.input disabled required :value="$canView ? $placeRequest->amount : '' " name="amount" />
                    </x-base.form-group>

                    <x-base.form-group label="Item Description" required class="col-md-4">
                        <x-base.textarea disabled required name="rider_phone">
                            {{ $canView ? $placeRequest->description : ''}}
                        </x-base.textarea>
                   
                    </x-base.form-group>
                    <x-base.form-group label="Delievery Note" required class="col-md-4">
                        <textarea class="form-control" name="note" disabled>
                            {{ $canView ? $placeRequest->note : ''}}
                        </textarea>
                    </x-base.form-group>
                    
                </div>
                {{-- <x-base.form-group class="text-center">
                    @if ($company->status == 'verified')
                    <x-base.button class="btn-primary">
                        Submit
                    </x-base.button>
                    @endif
                   
                </x-base.form-group> --}}
            {{-- </x-base.form> --}}
        </x-base.card>
    </div>
</div>
@if ($placeRequest->status == 'pending' && $canView)
<div class="row">
    <div class="col-12">
        <x-base.card title="Actions">

            <div class="row my-4 justify-content-between">
                <div class="col-md-2">
                    {{-- <x-modal-button class="btn-danger btn-block" key="reject">
                        Reject
                    </x-modal-button> --}}
                    {{-- <x-modal title="Reject" key="reject" data-backdrop="static" openOnFieldError="reject_message">
                        <x-base.form :action="route('applications.reject', $application->id)" spoof="DELETE">
                            <x-base.form-group label="Message">
                                <x-base.input type="text" id="reject_message" name="reject_message" />
                            </x-base.form-group>
                            <button class="btn btn-primary" type="">Submit</button>
                        </x-base.form>
                    </x-modal> --}}
                </div>
                <div class="col-md-4">
                    @if (!$user->isOwing())
                    <x-modal-button class="btn-info btn-block" key="review">
                        Accept Request
                    </x-modal-button>
                    <x-modal title="Review" key="review" data-backdrop="static" openOnFieldError="review_message">
                        <x-base.form :action="route('request.approve', $placeRequest->id)">
                            @php
                                
                            @endphp
                            <p>You are about to accept this request, an SMS will be sent to the customer and your rider will be notified of the details.</p>
                            <div class="row my-4 justify-content-between">
                                <div class="form-group col-md-4 offset-4">
                                    <x-base.form-group label="Assign A Rider">
                                        <x-base.select placeholder="--------------------" value="senior" name="rider">
                                          @forelse ($riders as $rider)
                                                {{-- @if (!$companyRouteService->riderIsBooked($rider->id, $rider->company_id) ||  $assignedRider == $rider->id ) --}}
                                                    <option {{$assignedRider == $rider->id ? 'selected' :''}} value="{{$rider->id}}">{{ $rider->user->name}}</option> 
                                                {{-- @endif --}}
                                           @empty
                                               
                                           @endforelse
                                        </x-base.select>
                                    </x-base.form-group>
                                </div>
                                
                            </div>
                            <button class="btn btn-primary">Yes Continue</button>
                        </x-base.form>
                    </x-modal>
                    @else
                        <p class='text-danger text-center'>
                            SORRY YOU CAN NOT ACCEPT REQUEST, YOUR BALANCE IS TOO LOW TO CARRY OUT THE OPERATION. KINDLY CREDIT YOUR WALLET
                        </p>
                    @endif
                    
                </div>
                <div class="col-md-2">
                    {{-- <x-base.form :action="route('request.approve', $placeRequest->id)">
                        <x-base.button class="btn-success btn-block">Accept Request</x-base.button>
                    </x-base.form> --}}
                </div>
            </div>

        </x-base.card>
    </div>
</div>
    
@endif
@endsection