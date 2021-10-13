@extends('layouts.dashboard')
@push('css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Create Daily Routes">
            <x-slot name="action">
                @if ($company->status !== 'verified')
                    <strong class="text-danger">Your account is currently under review </strong>
                @endif
            </x-slot>
            <x-base.form :action="route('company.route.store', $company->id)" autocomplete="off">
                <div class="form-row" x-data ="todayRoutes()">
                    <x-base.form-group label="Departure" required class="col-md-6">
                        <x-base.input type="time" required :value="old('departure')" name="departure"/>
                    </x-base.form-group>
                    <x-base.form-group label="Status" required class="col-md-6">
                        <x-base.select placeholder="---" required name="status">
                            @foreach (['available', 'transit', 'completed'] as $status)
                                <option {{$company->status == $status ? 'selected' : ''}} value="{{ $status }}">{{ ucwords($status) }}</option>
                            @endforeach
                        </x-base.select>
                    </x-base.form-group>
                    <x-base.form-group label="Rider" required class="col-md-12">
                        {{-- @dump($riders[0]->isBooked()) --}}
                        <x-base.select placeholder="---" required name="rider">
                            @foreach ($riders as $rider)
                                @if (!$rider->isBooked())
                                    <option value="{{ $rider->id }}">{{ ucwords($rider->user->name) }}</option>   
                                @endif
                            @endforeach
                        </x-base.select>
                    </x-base.form-group>
                    
                    <x-base.form-group label="Create Route" class="col-12"  x-init="onInit" x-cloak>
                        <x-base.button type="button" class="btn-primary" @click="addRoute">
                            <i class="fa fa-plus"></i>
                        </x-base.button>
                        <template x-for="(dailyRoute, index) in form.dailyRoutes" :key="index">
                            <div class="row">
                                <x-base.form-group label="Route" class="col-md-10">
                                    <x-base.input name="routeName[]" type="text" placeholder="Enter Route Name" x-model="dailyRoute.key" />
                                </x-base.form-group>
                                
                                <x-base.form-group class="col-md-2">
                                    <x-base.button type="button" class="btn-danger" @click="removeRoute(index)">
                                        <i class="fa fa-minus"></i>
                                    </x-base.button>
                                </x-base.form-group>
                            </div>
                        </template>
                    </x-base.form-group> 
                  
                </div>
                <x-base.form-group class="text-center">
                    @if ($company->status == 'verified')
                    <x-base.button class="btn-primary">
                        Submit
                    </x-base.button>
                    @endif
                   
                </x-base.form-group>
            </x-base.form>
        </x-base.card>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <x-base.card title="Company Daily Route">
            <x-slot name="action">
                <p>{{now()->format('d M, Y')}}</p>
            </x-slot>
            <x-base.datatable>
                <x-slot name="thead">
                    <th>Departure Time</th>
                    <th>Status</th>
                    <th>Routes</th>
                    <th>Pending Requests</th>
                    <th></th>
                </x-slot>

                <x-slot name="tbody">
                    @forelse($dailyRoutes as $dailyRoute)
                    @php
                        $direction = $dailyRoute->directions->pluck('name')->toArray();
                        $requests = $services->routeRequest($dailyRoute->id);
                    @endphp
                    <tr>
                        <td>{{$dailyRoute->departure}}</td>
                        <td>{{$dailyRoute->status}}</td>
                        <td>
                           {{implode(' >> ', $direction)}}
                        </td>
                        <td>
                            {{count($requests) ?? 0}}
                        </td>
                        <td>
                            @if (count($requests))
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
                        <td colspan="3">no rider created</td>
                    </tr>
                    
                    @endforelse
                </x-slot>
            </x-base.datatable>
        </x-base.card>
    </div>
</div>  
@push('scripts')
<script>

    function todayRoutes() {
        return {
            processing: false,
            errors: {},
            route: '',
            method: 'post',
            id: null,
            form: {
                dailyRoutes: [],
            },
            onInit() {
                const data = @json($dailyRoutes->toArray());
                if (data.dailyRoutes) {
                    for (const [key, value] of Object.entries(data.routes)) {
                        this.form.dailyRoutes.push({ key, value });
                    }
                }
            },
            addRoute() {
                const data = {key: '', value: ''};
                this.form.dailyRoutes.push(data);
            },
            removeRoute(index) {
                this.form.dailyRoutes.splice(index, 1);
            },
            
        }
    }
    // $('.ckeditor').ckeditor();
</script>
@endpush
@endsection