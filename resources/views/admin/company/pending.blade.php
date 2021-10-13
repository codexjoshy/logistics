@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <x-base.card title="Pending Company Registrations">
            <x-slot name="action">
                <p>{{now()->format('d M, Y')}}</p>
            </x-slot>
            <x-base.datatable>
                <x-slot name="thead">
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Phone</th>
                    <th>status</th>
                    <th></th>
                </x-slot>

                <x-slot name="tbody">
                    @forelse($companies as $company)
                    @php
                       $user = $company->user;
                    @endphp
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                           {{$user->phone}}
                        </td>
                        <td>
                            {{$company->status}}
                        </td>
                        <td>
                                <a href="{{route('admin.company.show', $company->id)}}"
                                    class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                    data-toggle="tooltip" data-placement="bottom" title="View" data-original-title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                            {{-- <a href="{{ route('company.riders.edit', [$company->id, $rider->id]) }}"
                                class="btn btn-datatable btn-icon btn-transparent-dark btn-primary mr-2"
                                data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">no Company created</td>
                    </tr>
                    
                    @endforelse
                </x-slot>
            </x-base.datatable>
        </x-base.card>
    </div>
</div>  
@endsection