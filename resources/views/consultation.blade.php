@extends('layouts.app')

@section('content')
    <!--=========================-->
    <!--=        Breadcrumb         =-->
    <!--=========================-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <section class="breadcrumb_area">
        <div class="vigo_container_two">
            <div class="page_header">
                <h1>LiveWell Consultation Booking</h1>
            </div>
            <!-- /.page-header -->
        </div>
        <!-- /.vigo_container_two -->
    </section>
    <!-- /.breadcrumb_area -->
    <br>
    <br>
    <br>
    <div class="container">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <span class="nav-link active tab-gene" data-method="paynow" id="ex1-tab-1" data-mdb-toggle="tab"
                    role="tab" aria-controls="ex1-tabs-1" aria-selected="true">PayNow</span>
            </li>
            <li class="nav-item" role="presentation">
                <span class="nav-link tab-gene" data-method="paypal" id="ex1-tab-2" data-mdb-toggle="tab" role="tab"
                    aria-controls="ex1-tabs-2" aria-selected="false">PayPal</span>
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" data-method="paynow" id="ex1-tabs-1" role="tabpanel"
                aria-labelledby="ex1-tab-1">
                <form action="{{ route('consultation.booking') }}" method="post" id="payment-form">
                    @csrf
                    <div class="mb-2 row">
                        <label for="join"
                            class="col-md-4 col-form-label text-md-end">{{ __('Date and time of consultation') }}</label>

                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control" name="date" required>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="message"
                            class="col-md-4 col-form-label text-md-end">{{ __('Booking Message') }}</label>

                        <div class="col-md-6">
                            <textarea id="message" type="text" class="form-control @error('description') is-invalid @enderror" rows="10"
                                name="message" value="{{ old('description') }}" required autocomplete="message" autofocus></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                    </div>

                    <div>
                        <input type="hidden" name="amount" type="tel" min="1" placeholder="Amount"
                            value="{{ $total }}">
                    </div>
                    <div>
                        <p>Our Consultation booking fee is USD ${{ $total }} or Equivalent</p>
                    </div>

                    </section>
                    <br>
                    <p class="sign-up-single-button" style="padding: 20px;width: fit-content;">
                        <input type="submit" value="  {{ __('Book Now With VISA CARD ') }}  ">

                    </p>

                </form>
            </div>
            <div class="tab-pane fade" data-method="paypal" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                <form method="post" action="/handle-payment">
                    @csrf
                    <div class="mb-2 row">
                        <label for="join"
                            class="col-md-4 col-form-label text-md-end">{{ __('Date and time of consultation') }}</label>

                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control" name="date" required>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="message"
                            class="col-md-4 col-form-label text-md-end">{{ __('Booking Message') }}</label>

                        <div class="col-md-6">
                            <textarea id="message" type="text" class="form-control @error('description') is-invalid @enderror" rows="10"
                                name="message" value="{{ old('description') }}" required autocomplete="message" autofocus></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                    </div>

                    <div>
                        <input type="hidden" name="amount" type="tel" min="1" placeholder="Amount"
                            value="{{ $total }}">
                    </div>
                    <div>
                        <p>Our Consultation booking fee is USD ${{ $total }} or Equivalent</p>
                    </div>

                    </section>
                    <br>
                    <p class="sign-up-single-button" style="padding: 20px;width: fit-content;">
                        <input type="hidden" name="consultation" value="1" />
                        <input type="submit" value="  {{ __('Book Now With PayPal ') }}  ">

                    </p>
                </form>
            </div>
        </div>
        <!-- Tabs content -->

    </div>



    <section class="call_to_action_green">
        <div class="vigo_container_two">
            <div class="call_to_action_area_two">
                <div class="row">
                    <div class="col-xl-10 offset-xl-2">
                        <div class="call_to_action_hello">
                            <div class="call_to_action_left_two">
                                <h2>Why Book for our consultation?</h2>
                                <p>We understand that seeking medical advice can be a daunting task, but booking a
                                    consultation with our experienced medical professionals can provide you with the peace
                                    of mind and personalized care you need. Our team is dedicated to providing you with the
                                    highest quality of care and attention, tailored to your individual needs. Whether you're
                                    seeking treatment for a specific condition or simply looking for preventative care, our
                                    consultations are designed to help you achieve optimal health and well-being. Don't
                                    hesitate - book your consultation today and take the first step towards a healthier,
                                    happier you!</p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        const tabs = document.querySelectorAll('.tab-gene');
        tabs.forEach(tab => {
            tab.style.cursor = 'pointer';
            tab.onclick = (e) => {
                const methodss = e.target.getAttribute('data-method');
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                });
                e.target.classList.add('active');
                const pans = document.querySelectorAll('.tab-pane');
                pans.forEach((pan) => {
                    pan.classList.remove('active');
                    pan.classList.remove('show');

                });
                document.querySelectorAll(`.tab-pane[data-method=${methodss}]`).forEach((meth) => {
                    meth.classList.add('show');
                    meth.classList.add('active');
                })
            }
        });
    </script>
@endsection
