@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="Company Profile">
            <x-slot name="action">
                @if(optional($user->company)->status == 'review') 
                <x-modal-button class="btn-info btn-sm" key="review">
                    Review
                </x-modal-button>
                <x-modal title="Review" key="review" data-backdrop="static" openOnFieldError="review_message">
                    
                </x-modal>
                @endif
                <small>Account Status: <strong>{{optional($user->company)->status ?? ''}}</strong></small>
            </x-slot>
            <x-base.form :action="route($webRoute, $company->id??'')" enctype="multipart/form-data" autocomplete="off">
                <div class="form-row">
                    <x-base.form-group label="Company Name" required class="col-md-6">
                        <x-base.input :disabled="$verified" :value="old('company_name')?? optional($user->company)->company_name" required id="company_name" name="company_name" type="text" />
                    </x-base.form-group>
                    <x-base.form-group label="Company Email Address" required class="col-md-6">
                        <x-base.input :value="old('company_email')?? $user->company? optional($user->company)->company_email : $user->email" required id="company_email" name="company_email" type="email" />
                    </x-base.form-group>
                    <x-base.form-group label="Company Phone Number" required class="col-md-6">
                        <x-base.input :value="old('company_phone') ?? optional($user->company)->company_phone" required id="company_phone" required name="company_phone" type="number" />
                    </x-base.form-group>
                    <x-base.form-group label="Company RC Number" required class="col-md-6">
                        <x-base.input :disabled="$verified" :value="old('rc_no')?? optional($user->company)->rc_no" required id="rc_no" name="rc_no" type="text" />
                    </x-base.form-group>
                    <x-base.form-group label="Company Slogan" required class="col-md-12">
                        <x-base.input  :value="old('slogan')?? optional($user->company)->slogan" required id="slogan" name="slogan" type="text" />
                    </x-base.form-group>
                    @if ($verified)
                    <div class="form-group">
                        <a target="_blank" href="{{Storage::url(optional($user->company)->cac)}}">View Uploaded CAC</a>
                    </div>
                    @else
                    <small class="text-success">Providing your CAC document enables your company to be verified by our platform</small>
                    <x-base.form-group label="Upload CAC"  class="col-md-12">
                        <x-base.input :value="old('cac')"  id="cac" name="cac" type="file" />
                    </x-base.form-group>
                    @endif
                   
                    <x-base.form-group label="Company Logo"  class="col-md-12">
                        <x-base.input :value="old('logo')"  id="logo" name="logo" type="file" />
                    </x-base.form-group>
                    @if ($user->company && $user->company->logo)
                        <div class="my-4" style="width:100px;height:100px;border-radius:50px;margin:auto;">
                           <img src="{{Storage::url($user->company->logo)}}" alt="logo" class="img-responsive img-fluid"/>
                        </div>
                        
                    @endif
                    
                </div>
                <x-base.form-group class="text-center">
                    <x-base.button class="btn-primary">
                        {{$user->company ? 'Update': 'Submit'}}
                    </x-base.button>
                </x-base.form-group>
            </x-base.form>
        </x-base.card>
    </div>
</div>
@endsection 

