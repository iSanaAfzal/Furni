@extends('Furni Layouts.master')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartitems as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('/storage/' . $item->product->image) }}" alt="Image"
                                                class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item->product->name }}</h2>
                                        </td>
                                        <td>${{ $item->product->price }}</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="button"
                                                        onclick="updateQuantity({{ $item->id }}, 'decrease')"
                                                        data-id="{{ $item->id }}">&minus;</button>
                                                </div>
                                                <input type="text" class="form-control text-center quantity-amount"
                                                    value="{{ $item->quantity }}" id="quantity__{{ $item->id }}"
                                                    readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="button"
                                                        onclick="updateQuantity({{ $item->id }}, 'increase')"
                                                        data-id="{{ $item->id }}">&plus;</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-total" id="price__{{ $item->id }}">
                                            ${{ $item->product->price * $item->quantity }}</td>
                                        <td><a href="{{ route('furni.removecart', $item->id) }}"
                                                class="btn btn-black btn-sm">X</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-black">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="cart-subtotal">${{ $subtotal }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="cart-total">${{ $total }}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-black btn-lg py-3 btn-block"
                                        onclick="window.location='{{ route('furni.checkout') }}'">Proceed To
                                        Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function updateQuantity(id, type) {
            $.ajax({
                url: '/cart/quantity/' + id,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    action: type
                },
                success: function(response) {
                    if (response.quantity !== undefined && response.product !== undefined) {
                        // Update the quantity in the input field
                        $('#quantity__' + id).val(response.quantity);

                        // Update the price for this item
                        const price = parseFloat(response.product.price);
                        const total = parseFloat(response.quantity) * price;
                        $('#price__' + id).html('$' + total.toFixed(2));

                        // Update the cart totals
                        updateCartTotals();

                        console.log('Quantity updated successfully', response);
                    } else {
                        console.error('Invalid response format', response);
                    }
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr.responseText);
                }
            });
        }

        function updateCartTotals() {
            let subtotal = 0;

            $('.product-total').each(function() {
                // Remove '$' and any potential spaces
                let totalText = $(this).text().replace('$', '').trim();

                // Convert to float and ensure it's a valid number
                let total = parseFloat(totalText);

                if (!isNaN(total)) {
                    subtotal += total;
                } else {
                    console.warn('Non-numeric value encountered:', totalText);
                }
            });

            // For simplicity, assume total is the same as subtotal
            let total = subtotal;

            // Update the subtotal and total display
            $('#cart-subtotal').html('$' + subtotal.toFixed(2));
            $('#cart-total').html('$' + total.toFixed(2));
        }
    </script>
@endsection
