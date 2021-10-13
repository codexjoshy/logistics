@extends('layouts.dashboard')

@section('content')
<x-invoice :transaction="$transaction">
    <x-slot name="thead">
        <th scope="col">Description</th>
        <th class="text-right" scope="col">Amount</th>
    </x-slot>
    <x-slot name="tbody">
        <x-invoice-item :amount="$transaction->amount"
            title='WALLET CREDITING'>
            <div class="small text-muted d-none d-md-block">{{ $transaction->description ?? 'Payment Description' }} </div>
        </x-invoice-item>

        <!-- Invoice subtotal-->
        <x-invoice-total  title="Subtotal" :amount="$transaction->amount" />

        <!-- Invoice total-->
        <x-invoice-total  title="Total Amount Due" :amount="$transaction->amount" class="text-green" />
    </x-slot>
</x-invoice>
@endsection
