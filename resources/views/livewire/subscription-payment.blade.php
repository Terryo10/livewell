<div>
    <form id="form" action="{{ url('subscription-checkout') }}" method="post">
        @csrf
        <p>Our Subscription Cost Is ${{ $pricing->price }} Per Month</p>
         <button style="width: fit-content !important;margin: 20px 0px;" class="btn btn-primary btn-lg btn-block" id="submit">Paynow VISA/MASTERCARD</button>
    </form>
    <form method="post" action="/handle-payment">
        @csrf
       <input type="hidden" name="subscription" value="1" />
        <button style="width: fit-content !important;margin: 20px 0px;" type="submit" class="btn btn-primary btn-lg btn-block">
         Activate using PayPal
        </button>
    </form>
</div>
