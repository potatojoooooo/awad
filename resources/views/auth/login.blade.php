<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card text-black" style="border-radius:10px">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</div>
                                    <div class="card-body p-md-0 mx-md-4">
                                        <div class="text-center">
                                            <img src="{{URL::asset('/image/logo.png')}}" style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">jo salone</h4>
                                        </div>
                                        @isset($url)
                                        <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                                            @else
                                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                                @endisset
                                                @csrf
                                                <div class="form-outline mb-4">
                                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label for="password" class="form-label">{{ __('Password') }}</label>

                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="text-center pt-1 mb-5 pb-1">
                                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-center pb-4">
                                                    <p class="mb-0 me-2">Don't have an account?</p>
                                                    <a href="{{ route('register') }}" class="btn btn-outline-danger m-2">Register</a>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0 d-none d-sm-block">
                                    <img src="{{URL::asset('/image/login.jpg')}}" alt="Login image" class="w-100 h-100" style="object-fit: cover; object-position: left;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</body>

</html>