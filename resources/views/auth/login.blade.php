@extends('layouts.app')



@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header text-center p-3 "
                        style="background: #3b5d50;
    font-size: 28px;
    color: #f9bf29;
    font-family: ui-sans-serif;
    font-weight:500">
                        {{ __('Login') }}</div>

                    <div class="card-body mt-5 mb-5 ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 row  ">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end"style="font-size:16px">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control  shadow @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end"style="font-size:16px">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control  shadow  @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary ">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn "
                                            href="{{ route('password.request') }}"style="background=#3b5d50;">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
