@extends('Furni Layouts.master')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <!-- Billing Details Form -->
                    <div class="p-3 p-lg-5 border bg-white">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>

                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="billing-form">
                            @csrf
                            <!-- First Name -->
                            <div class="form-group mb-4">
                                <label for="first_name" class="text-black">First Name</label>
                                <input type="text" id="first_name" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="form-group mb-4">
                                <label for="last_name" class="text-black">Last Name</label>
                                <input type="text" id="last_name" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company Name (optional) -->
                            <div class="form-group mb-4">
                                <label for="company_name" class="text-black">Company Name (optional)</label>
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control @error('company_name') is-invalid @enderror"
                                    value="{{ old('company_name') }}">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-group mb-4">
                                <label for="address" class="text-black">Address</label>
                                <input type="text" id="address" name="address"
                                    class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                                    required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State/Country -->
                            <div class="form-group mb-4">
                                <label for="state_country" class="text-black">State/Country</label>
                                <input type="text" id="state_country" name="state_country"
                                    class="form-control @error('state_country') is-invalid @enderror"
                                    value="{{ old('state_country') }}" required>
                                @error('state_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Postal/ZIP Code -->
                            <div class="form-group mb-4">
                                <label for="postal_zip" class="text-black">Postal/ZIP Code</label>
                                <input type="text" id="postal_zip" name="postal_zip"
                                    class="form-control @error('postal_zip') is-invalid @enderror"
                                    value="{{ old('postal_zip') }}" required>
                                @error('postal_zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mb-4">
                                <label for="email_address" class="text-black">Email Address</label>
                                <input type="email" id="email_address" name="email_address"
                                    class="form-control @error('email_address') is-invalid @enderror"
                                    value="{{ old('email_address') }}" required>
                                @error('email_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group mb-4">
                                <label for="phone_no" class="text-black">Phone Number</label>
                                <input type="text" id="phone_no" name="phone_no"
                                    class="form-control @error('phone_no') is-invalid @enderror"
                                    value="{{ old('phone_no') }}" required>
                                @error('phone_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hidden Total Bill -->
                            <input type="hidden" id="total_bill" name="total_bill" value="{{ $total }}">


                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Coupon Code Form -->
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have
                                    one</label>
                                <div class="input-group w-75 couponcode-wrap">
                                    <input type="text" class="form-control me-2" id="c_code"
                                        placeholder="Coupon Code">
                                    <div class="input-group-append">
                                        <button class="btn btn-black btn-sm" type="button"
                                            id="apply-coupon">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary and Payment Details Form -->
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->product->name }} <strong class="mx-2">x</strong>
                                                    {{ $item->quantity }}</td>
                                                <td>${{ $item->product->price * $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{ $total }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h2 class="h3 mb-3 text-black">Payment Details</h2>

                                <!-- Stripe Elements Placeholder -->
                                <div class="form-group mb-4">
                                    <label for="card-element" class="text-black">Credit or debit card</label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <button class="btn btn-black btn-lg py-3 btn-block" id="submit-button"
                                        style="background: #3b5d50;">Place Order</button>
                                </div>
                                <div id="payment-message" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stripe = Stripe(
                'pk_test_51PUOfVGBs791wXmMN4kckXmrW2CrIrRbBTn5FSPrxOx33jVugKWcndhP1WMUMAkG2ZzwM0WZcxPmJdSR139j32DG00s3pjwdlG'
            );
            var elements = stripe.elements();

            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            var card = elements.create('card', {
                style: style
            });
            card.mount('#card-element');

            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var submitButton = document.getElementById('submit-button');

            submitButton.addEventListener('click', function(event) {
                event.preventDefault();
                submitButton.disabled = true; // Disable the button to prevent multiple submissions

                stripe.createPaymentMethod('card', card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        submitButton.disabled = false; // Re-enable the button
                    } else {
                        stripePaymentMethodHandler(result.paymentMethod.id);
                    }
                });
            });

            function stripePaymentMethodHandler(paymentMethodId) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/process'; // Adjust the action URL as needed

                // Create a FormData object and append all form fields
                var formData = new FormData(document.querySelector('#billing-form'));

                // Append cart items to formData
                @foreach ($cartItems as $item)
                    formData.append('cart_items[]', JSON.stringify({
                        id: '{{ $item->product->id }}',
                        name: '{{ $item->product->name }}',
                        quantity: '{{ $item->quantity }}',
                        price: '{{ $item->product->price }}'
                    }));
                @endforeach

                formData.append('paymentMethodId', paymentMethodId);

                // Create hidden inputs for each form data and append to form
                for (var pair of formData.entries()) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', pair[0]);
                    hiddenInput.setAttribute('value', pair[1]);
                    form.appendChild(hiddenInput);
                }

                document.body.appendChild(form);
                form.submit();
            }

            // Handle the server response
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('payment_success')) {
                var messageElement = document.getElementById('payment-message');
                if (urlParams.get('payment_success') === 'true') {
                    messageElement.textContent = 'Payment successful!';
                    messageElement.classList.add('text-success');
                } else {
                    messageElement.textContent = 'Payment failed. Please try again.';
                    messageElement.classList.add('text-danger');
                }
            }
        });
    </script>
@endsection
