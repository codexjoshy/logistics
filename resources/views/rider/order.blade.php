@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="My Order">
            <x-slot name="action">
                <p>Status: {{$order->status}}</p>
            </x-slot>
            <X-slot name="action">
                <strong>Order ID: order-{{$order->code}}</strong>
            </X-slot>
            @php
                $companyRequest = $order->companyRequest;
            @endphp
            <x-base.form :action="route('rider.order.update', $order->id)" method="post">
                <div class='form-group'>
                    <p>Pickup : {{$companyRequest ? $companyRequest->pickup_address : ''}}</p>
                    <p>Destination: {{$companyRequest ? $companyRequest->delievery_address : ''}}</p>
                </div>
                <x-base.form-group label="Enter OTP" required class="col-md-6">
                    <x-base.input type="text" required :value="old('otp')" name="otp"/>
                </x-base.form-group>
                <x-base.button class="btn-primary">
                    Submit
                </x-base.button>
            </x-base.form>
        </x-base.card>
    </div>
</div>
@endsection