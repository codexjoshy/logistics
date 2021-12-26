@extends('layouts.dashboard')

@section('content')
    @can('rider')
        @include('partials.dashboards.rider')
    @endcan
    @can('company')
        @include('partials.dashboards.company')
    @endcan
    @can('admin')
        @include('partials.dashboards.admin')
    @endcan
    @if(!in_array(auth()->user()->type, ['rider','company', 'admin']))
    <x-base.card title="Dasboard">
        {{ __('You are logged in!') }}
        <p class="my-3">You are logged in as a customer</p>
        <p> We are happy to have you has a customer with Booklogistic </p>
    </x-base.card>
    @endif
@endsection
