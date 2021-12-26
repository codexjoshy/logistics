<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    @if (auth()->user()->company)
    @if (optional(auth()->user()->company)->status == 'verified')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                href="{{route('company.wallet')}}"> Account Balance</a>
                        </div>
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
    <!-- Total riders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <a class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                href="{{route('company.riders.create')}}">Total Riders</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{optional(auth()->user()->company)->no_of_riders}}</div>
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
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                href="{{route('company.daily.request')}}">Daily Pending Requests</a>
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
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                href="{{route('company.daily.order')}}">Accepted Requests</a>
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
                            <a class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                href="{{route('company.daily.order')}}">Orders in Transit</a>
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
                            <a class="text-info" href="{{route('company.daily.order')}}"> Completed Orders
                                <small>(daily)</small></a>
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
                            <a class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                                href="{{route('company.daily.pool')}}">Pool Requests</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    @endif
    @endif
</div>
<div class="row">
    <div class="col-12">
        <x-base.card title="Dashboard">
            @if (auth()->user()->company->status == 'verified')
            <p>Company Link: <a target="_blank" href="{{$url}}"><strong>{{$url}}</strong></a></p>
            <p>
                As a verified Registered Operator on this platform, ckick on the link below to join the operators
                whatsap group get our latest information and support
            </p>
            <p><a target="_blank" href="{{$groupUrl}}">Click to Join Operator Whatsap Group</a></p>

            @else
            <h3>Your Registeration is currently in {{optional(auth()->user()->company)->status ?? 'pending'}}</h3>
            @if(optional($user->company)->status == 'review')
            <x-modal-button class="btn-info btn-sm" key="review">
                Review
            </x-modal-button>
            <x-modal title="Review" key="review" data-backdrop="static" openOnFieldError="review_message">
                <p>{{optional($user->company)->reason}}</p>
            </x-modal>
            @endif
            @endif
        </x-base.card>
    </div>
</div>