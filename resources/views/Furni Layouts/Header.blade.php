<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsFurni">
            <ul class="navbar-nav  ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('furni.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('furni.shop') }}">Shop</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('furni.about') }}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('furni.services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('furni.blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('furni.contact') }}">Contact us</a>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><img src="{{ asset('assets/images/user.svg') }}"></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('furni.cartshow') }}">
                        <img src="{{ asset('assets/images/cart.svg') }}" alt="Cart Icon">

                        @auth
                            @php

                                $cart = App\Models\Cart::where('user_id', Auth::user()->id)->first();
                                $cartitems = App\Models\CartItems::where('cart_id', $cart->id)->count();
                            @endphp
                            <span class="cart-count"> {{ $cartitems }}</span>
                        @endauth
                    </a>
                </li>


                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Register') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item"
                                    href="{{ route('user.register', ['role' => 'buyer']) }}">{{ __('Buyer') }}</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('user.register', ['role' => 'seller']) }}">{{ __('Seller') }}</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
