@extends('layouts.dashboard')
@push('css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script async  type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api')}}&sensor=false&libraries=places"></script>

@endpush

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Create Prices For The Application">
            <x-slot name="action">
               
            </x-slot>
            <x-base.form :action="route('admin.option.price.store')" autocomplete="off">
                <div class="form-row" x-data ="todayRoutes()">
                    <x-base.form-group label="Create Price Range" class="col-12"  x-init="onInit" x-cloak>
                        <x-base.button type="button" class="btn-primary" @click="addRoute">
                            <i class="fa fa-plus"></i>
                        </x-base.button>
                        <template x-for="(dailyRoute, index) in form.dailyRoutes" :key="index">
                            <div class="row">
                                <x-base.form-group label="From (Distance in KM)" class="col-md-3">
                                    <x-base.input x-bind:value="`${dailyRoute.from}`" x-bind:id="`route-${index}`" x-bind:name="`distance-${index}[]`" type="text" placeholder="Enter distance e.g 5"  />
                                </x-base.form-group>
                                <x-base.form-group label="To (Distance in KM)" class="col-md-3">
                                    <x-base.input x-bind:value="`${dailyRoute.to}`" x-bind:id="`route-${index}`"  x-bind:name="`distance-${index}[]`" type="text" placeholder="Enter distance e.g 10"  />
                                </x-base.form-group>
                                <x-base.form-group label="Amount (regular)" class="col-md-3">
                                    <x-base.input x-bind:value="`${dailyRoute.regular}`" x-bind:id="`route-${index}`"  x-bind:name="`distance-${index}[]`" type="text" placeholder="Enter Amount"  />
                                </x-base.form-group>
                                <x-base.form-group label="Amount (express)" class="col-md-3">
                                    <x-base.input x-bind:value="`${dailyRoute.express}`" x-bind:id="`route-${index}`"  x-bind:name="`distance-${index}[]`" type="text" placeholder="Enter Amount"  />
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
                    <x-base.button class="btn-primary">
                        Update
                    </x-base.button>
                   
                </x-base.form-group>
            </x-base.form>
        </x-base.card>
    </div>
</div>
@push('scripts')
<script>

    function todayRoutes() {
        const dRoute =  @json($prices);
        let dailyRoutes = dRoute.map((item, index)=>item);
        console.log(dailyRoutes);
        return {
            data:dRoute,
            processing: false,
            errors: {},
            route: '',
            method: 'post',
            id: null,
            form: {
                dailyRoutes

            },
            onInit() {
                // this.form.push({ke:'valse'});
                const data = @json($prices);
                // console.log(data[0]);
                if (dailyRoutes) {
                    
                }
                // console.log(this.form.dailyRoutes[0]);
            },
            addRoute() {
                const data = {from: '', to: '', regular:'', express:''};
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