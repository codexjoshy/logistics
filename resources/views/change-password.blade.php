@extends('layouts.dashboard')

@section('content')
<x-base.card title="Update Password">
    <x-base.form :action="route('update.password')" enctype="multipart/form-data" autocomplete="off">
        <div class="form-row">
            <x-base.form-group label="Old Password" required class="col-md-12">
                <x-base.input required id="old" name="old" type="password" />
            </x-base.form-group>
            <x-base.form-group label="New Password" required class="col-md-12">
                <x-base.input required id="password" name="password" type="password" />
            </x-base.form-group>
            <x-base.form-group label="Confirm Password" required class="col-md-12">
                <x-base.input required id="password" name="password_confirmation" type="password" />
            </x-base.form-group>
            <x-base.form-group class="text-center">
                <x-base.button class="btn-primary">
                    Update
                </x-base.button>
            </x-base.form-group>
        </div>  
    </x-base.form>

</x-base.card>
@endsection