@extends('layouts.dashboard')

@section('content')

 <!-- Content Row -->
 <div class="row">
    @can('company')
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          <a class="text-xs font-weight-bold text-primary text-uppercase mb-1"  href="{{route('company.wallet')}}"> Account Balance</a> </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{toNaira(auth()->user()->balance())}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-money fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if (auth()->user()->company)
    <!-- Total riders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="{{route('company.riders.create')}}">Total Riders</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{optional(auth()->user()->company)->no_of_riders}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-bicycle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Pending Requests -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="{{route('company.daily.request')}}">Daily Pending Requests</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$companyRequest}}</div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Assigned Orders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="{{route('company.daily.order')}}">Accepted Requests</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{$assignedOrders}}
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Transit -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="{{route('company.daily.order')}}">Orders in Transit</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{$orderInTransit}}
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Completed Orders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a class="text-info" href="{{route('company.daily.order')}}"> Completed Orders <small>(daily)</small></a>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{$completedOrders}}
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-trophy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-warning text-uppercase mb-1" href="{{route('company.daily.pool')}}">Pool Requests</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endif
    @endcan
    @can('admin')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Registered Companies</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{$registerdCompanies}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pool Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
<div class="row">
    <div class="col-12">
        @can('rider')
            <x-base.card title="My Daily Routes" class="mb-4">
                <x-slot name="action">
                    <p>{{now()->format('d M, Y')}}</p>
                </x-slot>
                <x-base.datatable>
                    <x-slot name="thead">
                        <th>Departure Time</th>
                        <th>Status</th>
                        <th>Routes</th>
                        <th></th>
                    </x-slot>
    
                    <x-slot name="tbody">
                        @forelse($dailyRoutes as $dailyRoute)
                        @php
                            $direction = $dailyRoute->directions->pluck('name')->toArray();
                            #$requests = $services->routeRequest($dailyRoute->id);
                        @endphp
                        <tr>
                            <td>{{$dailyRoute->departure}}</td>
                            <td>{{$dailyRoute->status}}</td>
                            <td>
                               {{implode(' >> ', $direction)}}
                            </td>
                           
                            <td>
                                @if (false)
                                    <a href="{{route('company.route.request', $dailyRoute->id)}}"
                                        class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                        data-toggle="tooltip" data-placement="bottom" title="View" data-original-title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif
                                {{-- <a href="{{ route('company.riders.edit', [$company->id, $rider->id]) }}"
                                    class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                    data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">no route created</td>
                        </tr>
                        
                        @endforelse
                    </x-slot>
                </x-base.datatable>
            </x-base.card>
            <x-base.card title="My Daily Orders">
                <x-slot name="action">
                </x-slot>
                <x-base.datatable>
                    <x-slot name="thead">
                        <th>Tracking ID</th>
                        <th>Pickup Address</th>
                        <th>Delivery Address</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Rider Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </x-slot>
    
                    <x-slot name="tbody">
                        @forelse($orders as $order)
                        @php
                            $routeRequest = $order->companyRequest;
                            $code = "{$order->company_id}{$order->id}{$order->rider->id}";
                            $date = $order->created_at->format('Y-m-d');
                            if ($order->created_at->format('Y-m-d') == now()->format('Y-m-d')) {
                                $date = $order->created_at->diffForHumans();
                            }
                            
                        @endphp
                        <tr>
                            <td>#order-{{$code}}</td>
                            <td>{{$routeRequest->pickup_address}}</td>
                            <td>{{$routeRequest->delievery_address}}</td>
                            <td>{{$routeRequest->customer->name}}</td>
                            <td>{{$routeRequest->customer->phone}}</td>
                            <td>{{$order->rider->user->name}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$date}}</td>
                            <td>
                                {{-- <a href="{{route('company.order.show', $order->id)}}"
                                    class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                    data-toggle="tooltip" data-placement="bottom" title="View" data-original-title="View">
                                    <i class="fa fa-eye"></i>
                                </a> --}}
                                <a href="{{ route('rider.order', [$order->id]) }}"
                                    class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                    data-toggle="tooltip" data-placement="bottom" title="View" data-original-title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">No Order as been assigned to you</td>
                        </tr>
                        
                        @endforelse
                    </x-slot>
                </x-base.datatable>
            </x-base.card>
        @endcan
        @can('company')
            <x-base.card title="Dashboard">
                <p>Company Link: <a target="_blank" href="{{$url}}"><strong>{{$url}}</strong></a></p>
            </x-base.card>
        @endcan
        @can('admin')
            <x-base.card title="Dasboard">
                {{ __('You are logged in!') }}
                <p class="my-3">Click the link below to verify registered companies</p>
                <p>
                    <a target="_blank" href="https://apps.firs.gov.ng/tinverification/">Verification Link</a>
                </p>
            </x-base.card>
        @endcan
        @if(!in_array(auth()->user()->type, ['rider','company', 'admin']))
        <x-base.card title="Dasboard">
            {{ __('You are logged in!') }}
            <p class="my-3">You are logged in as a customer</p>
            <p> We are happy to have you has a customer with Booklogistic </p>
        </x-base.card>
        @endif
        
    </div>
</div>
@endsection
