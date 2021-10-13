@extends('layouts.dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Customer Information">
            <x-slot name="action">
               <span>Order Status: {{$order->status}}</span>
            </x-slot>
                @php
                    $customer = $placeRequest->customer;
                @endphp
                <div class="form-row">
                    <x-base.form-group label="Customer Name" required class="col-md-4">
                        <x-base.input disabled required :value="$customer->name" name="rider_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Customer Email" required class="col-md-4">
                        <x-base.input disabled required :value="$customer->email" name="rider_email" />
                    </x-base.form-group>
                    <x-base.form-group label="Customer Phone Number" required class="col-md-4">
                        <x-base.input disabled required :value="$customer->phone" name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Pickup Address" required class="col-md-4">
                        <x-base.input disabled required :value="$placeRequest->pickup_address" name="rider_address" />
                    </x-base.form-group>
                    <x-base.form-group label="Delievery Address" required class="col-md-4">
                        <x-base.input disabled required :value="$placeRequest->delievery_address" name="rider_address" />
                    </x-base.form-group>
                    <x-base.form-group label="Reciever Name" required class="col-md-4">
                        <x-base.input disabled required :value="$placeRequest->reciever_name" name="rider_name"/>
                    </x-base.form-group>
                    
                    <x-base.form-group label="Reciever Phone Number" required class="col-md-4">
                        <x-base.input disabled required :value="$placeRequest->reciever_phone" name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Customer OTP" required class="col-md-4">
                        <x-base.input disabled required :value="optional($placeRequest->order)->customer_otp" name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Reciever OTP" required class="col-md-4">
                        <x-base.input disabled required :value="optional($placeRequest->order)->reciever_otp" name="rider_phone" />
                    </x-base.form-group>
                </div>
        </x-base.card>
    </div>
    <div class="col-12 mt-4">
        @php
            $code = "{$order->company_id}{$order->id}{$order->rider->id}";
        @endphp
        <x-base.card title="Order Information">
            <x-slot name="action">
                <span>Tracking Number : #order-{{$code}}</span>
            </x-slot>
            <x-base.form :action="route('company.order.update', $order->id)" autocomplete="off" enctype="multipart/form-data">

                <div class="form-row">
                    <x-base.form-group label="Rider Name" required class="col-md-4">
                        <x-base.input disabled required :value="$rider->user->name" name="rider_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Rider Phone" required class="col-md-4">
                        <x-base.input disabled required :value="$rider->user->phone" name="rider_phone"/> 
                    </x-base.form-group>
                    <x-base.form-group label="Rider Unique Identification" required class="col-md-4">
                        <x-base.input disabled required :value="$rider->rider_uid" name="rider_uid" />
                    </x-base.form-group>
                    <x-base.form-group label="Update Order Status" class="col-sm-12">
                        <x-base.select placeholder="---" id="status" name="status">
                            @foreach (['pending', 'accepted', 'in-transit', 'delievered'] as $status)
                            <option {{$order->status == $status ? 'selected' : ''}} value="{{ $status }}">{{ ucwords($status) }}</option>
                            @endforeach
                        </x-base.select>
                    </x-base.form-group>
                    <x-base.form-group class="col-12 d-flex align-items-center justify-content-center">
                        <x-base.button class="btn-primary">
                            Update
                        </x-base.button>
                    </x-base.form-group>
                </div>
            </x-base.form>
        </x-base.card>
    </div>
</div>
@endsection