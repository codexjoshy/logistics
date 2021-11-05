@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="Requests">
            @php
                // $direction = $dailyRoute->directions->pluck('name')->toArray();
                // $requests = $services->placeRequest($dailyRoute->id);
                $user = auth()->user();
                $balance = $user->balance();
                $totalAmount = $placeRequests->sum('amount');
                $balance = $user->balance();
                $percentAmount = 0.1 * $totalAmount;

                $canView = !$user->isOwing() && $balance > $percentAmount;

            @endphp
            <x-slot name="action">
               @if (!$canView)
                   <p class="text-danger"><small>Sorry, you do not have enough funds to view the customer request. </small> 
                    <a href="{{route('company.wallet')}}" class='btn btn-sm btn-success'>Fund Wallet</a></p>
               @endif
            </x-slot>
            <x-base.datatable>
                <x-slot name="thead">
                    <th></th>
                    <th>Pickup Address</th>
                    <th>Delivery Address</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th></th>
                </x-slot>

                <x-slot name="tbody">
                   
                    @forelse($placeRequests as $placeRequest)
                    <tr>
                        <td></td>
                        <td>{{$canView ? $placeRequest->pickup_address : ''}}</td>
                        <td>{{$canView ? $placeRequest->delievery_address : ''}}</td>
                        <td>{{$placeRequest->customer->name}}</td>
                        <td>{{$canView ? $placeRequest->customer->phone : ''}}</td>
                        <td>
                            <a href="{{route('request.pending', $placeRequest->id)}}"
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
                        <td colspan="3">No Requests found</td>
                    </tr>
                    
                    @endforelse
                </x-slot>
            </x-base.datatable>
        </x-base.card>
    </div>
</div>  
@endsection