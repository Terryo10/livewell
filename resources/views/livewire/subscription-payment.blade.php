<div>
    <form id="form" action="{{ url('subscription-checkout') }}" method="post">
        @csrf
        <p>Our Subscription Cost Is ${{ $pricing->price }} Per Month</p>
        <div id="dropin-container"></div>
        <input type="hidden" id="nonce" name="payment_method_nonce" />
        <button id="submit">Request payment method</button>
    </form>



    <script type="text/javascript">
        // call `braintree.dropin.create` code here
        let token = @js($token);
        braintree.dropin.create({
            authorization: token,
            container: '#dropin-container',
            paypal: {
                flow: 'vault'
            }
        }, (error, dropinInstance) => {
            if (error) console.error(error);
            const form = document.getElementById('form');
            $("form").on('submit', function(e) {
                e.preventDefault();
                dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) console.error(error);
                    document.getElementById('nonce').value = payload.nonce;
                    HTMLFormElement.prototype.submit.call(form);
                })

            });
        });
    </script>
</div>
