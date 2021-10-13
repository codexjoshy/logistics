@props(['transaction'])


<p>Kindly make available your ATM to complete your transaction.</p>
<x-base.button type="button" class="btn-primary" id="paystack">
    <i class="icon icon-wallet"></i> Pay Online
</x-base.button>

@push('scripts')
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
    $('#paystack').click(payWithPaystack)
    function makePayment(e) {
        e.preventDefault();
        alert('Payment');
        // const paymentForm = document.getElementById('paymentForm');
        // paymentForm.addEventListener("submit", payWithPaystack, false);

    }
    function payWithPaystack(e) {
        e.preventDefault();
        let handler = PaystackPop.setup({
            key: "{{config('services.payment.paystack.key')}}", // Replace with your public key
            email: "{{$transaction->user->email}}",
            amount: {{$transaction->amount * 100}},
            ref: {{$transaction->reference}}, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function(){
            alert('Transaction Cancelled.');
            },
            callback: function(response){
                let url = "{{url('payment/verify/?ref=')}}"+response.reference;
                console.log(url);
                // window.location = "{{url('/')}}"+'payment/verify/?ref='+"{{$transaction->reference}}";
                window.location.replace(url);
            }
        });
        handler.openIframe();
    }
</script>
@endpush
