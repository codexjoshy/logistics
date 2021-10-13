@push('scripts')
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        function makePayment(amount, reference) {
            FlutterwaveCheckout({
                public_key: "{{ config('services.rave.public') }}",
                tx_ref: reference,
                amount,
                currency: "NGN",
                country: "NG",
                redirect_url:  "{{ route('payment.verify') }}",
                meta: {
                    consumer_id: "{{ auth()->id() }}",
                    consumer_mac: "92a3-912ba-1192a",
                },
                customer: {
                    email: "{{ auth()->user()->email }}",
                    phone_number: "{{ auth()->user()->phone }}",
                    name: "{{ auth()->user()->name }}",
                },
                // callback: function (data) {
                //     console.log(data);
                // },
                onclose: function() {
                    // close modal
                    console.log('Modal closed');
                },
                // customizations: {
                //     title: "My store",
                //     description: "Payment for items in cart",
                //     logo: "https://assets.piedpiper.com/logo.png",
                // },
            });
        }
    </script>
@endpush
