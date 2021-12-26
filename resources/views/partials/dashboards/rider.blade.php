
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
                $code = $order->code;
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