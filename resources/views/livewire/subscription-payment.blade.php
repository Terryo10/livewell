<div>
    <form id="form" action="{{ url('subscription-checkout') }}" method="post">
        @csrf
        <p>Our Subscription Cost Is ${{ $pricing->price }} Per Month</p>
         <button id="submit">Paynow VISA/MASTERCARD</button>
    </form>

</div>
