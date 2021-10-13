@props(['transaction'])

<div class="card invoice">
    <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-left">
                <!-- Invoice branding-->
                <img class="invoice-brand-img rounded-circle mb-4" src="{{ asset('assets/images/frontend/logo.png') }}" alt />
                <div class="h2 text-white mb-0">{{ config('app.name') }}</div>
            </div>
            <div class="col-12 col-lg-auto text-center text-lg-right">
                <!-- Invoice details-->
                <div class="h3 text-white">Invoice</div>
                #{{ $transaction->reference }}
                <br />
                {{ now()->format('M d, Y') }}
            </div>
        </div>
    </div>
    <div class="card-body p-4 p-md-5">
        <!-- Invoice table-->
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <thead class="border-bottom">
                    <tr class="small text-uppercase text-muted">
                        {{ $thead ?? ''}}
                    </tr>
                </thead>
                <tbody>
                    {{ $tbody ?? '' }}
                    <tr>
                        <td class="text-right pb-0 " colspan="2">
                            <x-paystack :transaction="$transaction" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer p-4 p-lg-5 border-top-0">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <!-- Invoice - sent to info-->
                <div class="small text-muted text-uppercase font-weight-700 mb-2">To</div>
                <div class="h6 mb-1">{{ config('app.name') }}</div>
                <div class="small">Lagos, Nigeria</div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <!-- Invoice - sent from info-->
                <div class="small text-muted text-uppercase font-weight-700 mb-2">From</div>
                <div class="h6 mb-0">{{'Company #'. auth()->user()->name ?: ''}}</div>
                <div class="small">{{ auth()->user()->email }}</div>
            </div>
            <div class="col-lg-6">
                <!-- Invoice - additional notes-->
                <div class="small text-muted text-uppercase font-weight-700 mb-2">Note</div>
                <div class="small mb-0">SECURED PAYMENT</div>
            </div>
        </div>
    </div>
</div>
