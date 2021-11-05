@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="offset-sm-4 col-sm-4 d-flex justify-content-center align-items-center">
        <img style='width: 10rem;' class="img-account-profile rounded-circle mb-2"
            src="{{  Storage::url($rider->passport ?? 'default.jpg') }}" alt="profile picture" />
    </div>
</div>
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Update Rider">
            <x-base.form :action="route('company.riders.update', [$company->id, $rider->id])" autocomplete="off" enctype="multipart/form-data">
                @php
                    $riderNames = $rider->riderNames();
                @endphp
                <div class="form-row">
                    <x-base.form-group label="Rider First Name" required class="col-md-4">
                        <x-base.input required :value="old('rider_first_name') ?? $riderNames['firstName']" name="rider_first_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Rider Last Name" required class="col-md-4">
                        <x-base.input required :value="old('rider_last_name') ?? $riderNames['lastName']" name="rider_last_name"/>
                    </x-base.form-group>
                    <x-base.form-group label="Rider Email" required class="col-md-4">
                        <x-base.input required :value="old('rider_email')?? $rider->user->email" name="rider_email"/> 
                    </x-base.form-group>
                    <x-base.form-group label="Rider Address" required class="col-md-4">
                        <x-base.input required :value="old('rider_address') ?? $rider->rider_address" name="rider_address" />
                    </x-base.form-group>
                    <x-base.form-group label="Rider Phone Number" required class="col-md-4">
                        <x-base.input required :value="old('rider_phone') ?? $rider->user->phone" name="rider_phone" />
                    </x-base.form-group>
                    <x-base.form-group label="Rider Unique Identification" required class="col-md-4">
                        <x-base.input required :value="old('rider_uid') ?? $rider->rider_uid" name="rider_uid" />
                    </x-base.form-group>
                    <x-base.form-group label="Status" class="col-md-4">
                        <x-base.select placeholder="---" id="status" name="status">
                            @foreach (['active', 'suspended', 'inactive'] as $status)
                            <option {{$rider->status == $status ? 'selected' : ''}} value="{{ $status }}">{{ ucwords($status) }}</option>
                            @endforeach
                        </x-base.select>
                    </x-base.form-group>
                    <x-base.form-group label="Upload Passport"  class="col-md-12">
                        <x-base.input :value="old('passport')"  id="passport" name="passport" type="file" />
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

@endsection
