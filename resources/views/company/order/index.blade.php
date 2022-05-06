@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="Daily Orders">
            <x-slot name="action">
            </x-slot>
            <x-base.datatable>
                <x-slot name="thead">
                    <th>Tracking ID</th>
                    <th>Pickup Address</th>
                    <th>Delivery Address</th>
                    <th>Amount</th>
                    {{-- <th>Customer Name</th>
                    <th>Customer Phone</th> --}}
                    <th>Rider Name</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </x-slot>

                <x-slot name="tbody">
                    @forelse($orders as $order)
                    @php
                        $routeRequest = $order->companyRequest;
                        $code =  $order->code;
                        $date = $order->created_at->format('Y-m-d');
                        if ($order->created_at->format('Y-m-d') == now()->format('Y-m-d')) {
                            $date = $order->created_at->diffForHumans();
                        }
                        
                    @endphp
                    <tr>
                        <td>#order-{{$code}}</td>
                        <td>{{$routeRequest->pickup_address}}</td>
                        <td>{{$routeRequest->delievery_address}}</td>
                        <td>{{$routeRequest->amount}}</td>
                        {{-- <td>{{$routeRequest->customer->name}}</td>
                        <td>{{$routeRequest->customer->phone}}</td> --}}
                        <td>{{$order->rider->user->name}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$date}}</td>
                        <td>
                            <a href="{{route('company.order.show', $order->id)}}"
                                class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                data-toggle="tooltip" data-placement="bottom" title="View" data-original-title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            {{-- <a href="{{ route('company.riders.edit', [$company->id, $rider->id]) }}"
                                class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">no rider created</td>
                    </tr>
                    
                    @endforelse
                </x-slot>
            </x-base.datatable>
        </x-base.card>
    </div>
</div>  
@endsection