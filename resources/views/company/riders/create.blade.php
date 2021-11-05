@extends('layouts.dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Create Riders">
            <x-slot name="action">
                @if ($company && $company->status !== 'verified')
                    <strong class="text-danger">Your account is currently under review </strong>
                @endif
            </x-slot>
            @if ($company)
            <x-base.form :action="route('company.riders.store', $company->id)" autocomplete="off">
                <div class="form-row">
                    <x-base.form-group label="Rider First Name" required class="col-md-4">
                        <x-base.input required :value="old('rider_first_name')" name="rider_first_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Rider Last Name" required class="col-md-4">
                        <x-base.input required :value="old('rider_last_name')" name="rider_last_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Rider Email" required class="col-md-4">
                        <x-base.input required :value="old('rider_email')" name="rider_email" />
                    </x-base.form-group>
                    <x-base.form-group label="Rider Address" required class="col-md-4">
                        <x-base.input required :value="old('rider_address')" name="rider_address" />
                    </x-base.form-group>
                    <x-base.form-group label="Rider Phone Number" required class="col-md-4">
                        <x-base.input required :value="old('rider_phone')" name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Rider Unique Identification" required class="col-md-4">
                        <x-base.input required :value="old('rider_uid')" name="rider_uid"/>
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
                
            @endif
        </x-base.card>
    </div>
</div>
@if ($company && $company->status == 'verified')
<div class="row">
    <div class="col-12">
        <x-base.card title="Company Riders">
            <x-base.datatable>
                <x-slot name="thead">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>UUID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </x-slot>

                <x-slot name="tbody">
                    @forelse($riders as $rider)
                    @php
                        $riderName = $rider->riderNames();
                    @endphp
                    <tr>
                        <td>{{$riderName['firstName']}}</td>
                        <td>{{$riderName['lastName']}}</td>
                        <td>{{$rider->user->email}}</td>
                        <td>{{$rider->user->phone}}</td>
                        <td>{{$rider->rider_uid}}</td>
                        <td>{{$rider->status}}</td>
                        <td>
                            <a href="{{ route('company.riders.edit', [$company->id, $rider->id]) }}"
                                class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
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
@endif
@endsection
