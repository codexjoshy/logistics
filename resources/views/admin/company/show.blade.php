@extends('layouts.dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Company Profile">
            <x-slot name="action">
                @if(optional($company)->status == 'review') 
                <x-modal-button class="btn-info btn-sm" key="review">
                    Review
                </x-modal-button>
                <x-modal title="Review" key="review" data-backdrop="static" openOnFieldError="review_message">
                    
                </x-modal>
                @endif
                <small>Account Status: <strong>{{optional($company)->status ?? ''}}</strong></small>
            </x-slot>
                <div class="form-row">
                    <x-base.form-group label="Company Name" required class="col-md-6">
                        <x-base.input disabled :value="old('company_name')?? optional($company)->company_name" required id="company_name" name="company_name" type="text" />
                    </x-base.form-group>
                    <x-base.form-group label="Company Email Address" required class="col-md-6">
                        <x-base.input disabled :value="old('company_email')?? $company->company_email" required id="company_email" name="company_email" type="email" />
                    </x-base.form-group>
                    <x-base.form-group label="Company Phone Number" required class="col-md-6">
                        <x-base.input disabled :value="old('company_phone') ?? optional($company)->company_phone" required id="company_phone" required name="company_phone" type="number" />
                    </x-base.form-group>
                    <x-base.form-group label="Company RC Number" required class="col-md-6">
                        <x-base.input disabled :value="old('rc_no')?? optional($company)->rc_no" required id="rc_no" name="rc_no" type="text" />
                    </x-base.form-group>
                    
                    @if ($company && $company->cac)
                        <div>
                            <a target="_blank" href="{{ Storage::url($company->cac) }}" class="btn btn-link">View CAC</a>
                        </div>
                    @endif
                    
                </div>
                <x-base.form-group class="text-center">
                    {{-- <x-base.button class="btn-primary">
                        {{$user->company ? 'Update': 'Submit'}}
                    </x-base.button> --}}
                </x-base.form-group>
        </x-base.card>
    </div>
</div>
@if ($company->status != 'verified')
    <div class="row mb-4">
        <div class="col-6">
            <form action="{{route('admin.company.accept', $company->id)}}" method="post" class="form-horizontal">
                @csrf
                <x-button class="btn-success btn-block">
                    ACCEPT
                </x-button>
            </form>
        
        </div>
        <div class="col-6">
            <x-modal-button class="btn-danger btn-block" key="reject">
                Reject
            </x-modal-button>
            <x-modal title="Rejected" key="reject" data-backdrop="static" openOnFieldError="reject_message">
                
                <p>Kindly State the Reason Bellow</p>
                <form action="{{route('admin.company.accept', $company->id)}}">
                    @csrf
                    <x-base.input name="reason"   /><br>
                    <button class="btn btn-primary">Submit</button>
                </form>

            </x-modal>
        </div>
    </div> 
@endif
@endsection 

