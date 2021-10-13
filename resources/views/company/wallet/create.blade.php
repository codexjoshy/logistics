@extends('layouts.dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <x-base.card title="Fund Wallet">
            <x-slot name="action">
                @if ($company && $company->status !== 'verified')
                    <strong class="text-danger">Your account is currently under review </strong>
                @endif
            </x-slot>
            <x-base.form :action="route('wallet.store', $company->user->id)" autocomplete="off">
                <div class="form-row">
                    <x-base.form-group label="Amount" required class="col-md-12">
                        <x-base.input required :value="old('amount')" name="amount"/>
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
<div class="form-row mb-4">
    <div class="col-12">
        <x-base.card title="Transactions">
            <x-base.datatable>
                <x-slot name="thead">
                    <th width="10">S/N</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                    <th></th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $transaction['created_at']->format('d M, Y H:i A') }}</td>
                        <td>{{ $transaction['description'] }}</td>
                        @if ($transaction['type'] == 'debit')
                        <td>{{ toNaira($transaction->amount)}}
                        </td>
                        @else
                        <td></td>
                        @endif
                        @if ($transaction['type'] == 'credit')
                        <td>{{ toNaira($transaction->amount)}}
                        </td>
                        @else
                        <td></td>
                        @endif
                        <td>
                            {{ toNaira($transaction->balance)}}
                        </td>
                        <td>
                            {{-- @if ($transaction['type'] == 'credit')
    
                            <a target="_blank" href="{{ route('transaction.reciept', $transaction->id) }}"
                                class="btn btn-outline-blue">Generate</a>
                            @endif --}}
                        </td>
                    </tr>
                    @empty
    
                    @endforelse
    
                </x-slot>
            </x-base.datatable>
        </x-base.card>
    </div>
</div>

@endsection
