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
            // $canView = !$user->isOwing() && $placeRequest->hasEnoughBalance($balance);
            $direction =  isset($routeRequests[0]) ? $routeRequests[0]->route->directions->pluck('name')->toArray() : '';

            @endphp
            <x-slot name="action">
            
            </x-slot>

            <x-base.datatable>
                <x-slot name="thead">
                    <th></th>
                    <th>Pickup Address</th>
                    <th>Delivery Address</th>
                    {{-- <th>Customer Name</th>
                    <th>Customer Phone</th> --}}
                    <th></th>
                </x-slot>

                <x-slot name="tbody">
                    
                    @forelse($routeRequests as $routeRequest)
                    <tr>
                        <td></td>
                        <td>{{$routeRequest->pickup_address }}</td>
                        <td>{{$routeRequest->delievery_address }}</td>
                        {{-- <td>{{$routeRequest->customer->name}}</td>
                        <td>{{$canView ? $routeRequest->customer->phone : ''}}</td> --}}
                        <td>
                            <a href="{{route('request.pending', $routeRequest->id)}}"
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