@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="Requests">
     
            <x-slot name="action">
                
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
                    @php
                        // $direction = $dailyRoute->directions->pluck('name')->toArray();
                        // $requests = $services->placeRequest($dailyRoute->id);
                    @endphp
                    <tr>
                        <td></td>
                        <td>{{$placeRequest->pickup_address}}</td>
                        <td>{{$placeRequest->delievery_address}}</td>
                        <td>{{$placeRequest->customer->name}}</td>
                        <td>{{$placeRequest->customer->phone}}</td>
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