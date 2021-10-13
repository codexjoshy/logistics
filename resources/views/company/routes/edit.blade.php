@extends('layouts.dashboard')
@push('css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script async  type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api')}}&sensor=false&libraries=places"></script>

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
            <x-base.form :action="route('company.route.update', [$company->id, $route->id])" autocomplete="off">
                <div class="form-row" x-data ="todayRoutes()">
                    <x-base.form-group label="Update Route" class="col-12"  x-init="onInit" x-cloak>
                        <x-base.button type="button" class="btn-primary" @click="addRoute">
                            <i class="fa fa-plus"></i>
                        </x-base.button>
                        <template x-for="(dailyRoute, index) in form.dailyRoutes" :key="index">
                            <div class="row">
                                <x-base.form-group label="Route" class="col-md-10">
                                    <x-base.input x-bind:id="`route-${index}`" oninput="handlePlaces(this.id)" name="routeName[]" type="text" placeholder="Enter Route Name" x-model="dailyRoute.key" />
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
                        Update
                    </x-base.button>
                    @endif
                   
                </x-base.form-group>
            </x-base.form>
        </x-base.card>
    </div>
</div>
@push('scripts')
<script>

    function todayRoutes() {
        const dRoute =  @json($dailyRoutes);
        let dailyRoutes = dRoute.map((item, index)=>({"key": item}));
        return {
            processing: false,
            errors: {},
            route: '',
            method: 'post',
            id: null,
            form: {
                dailyRoutes
            },
            onInit() {
                this.form.push({ke:'valse'});
                const data = @json($dailyRoutes);
                console.log(data);
                if (dailyRoutes) {
                    for (const [key, value] of Object.entries(data.routes)) {
                        this.form.dailyRoutes.push({ key, value });
                    }
                }
                console.log(this.form.dailyRoutes);
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
<script src="{{asset('assets/js/script.js')}}"></script>

@endpush
@endsection