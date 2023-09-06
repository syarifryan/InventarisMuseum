@extends('layouts.auth')

@section('content')

<div class="col-12 col-md-9 col-xl-7 col-xxxl-5 px-8 px-sm-0 pt-64 pb-48">
    <div class="d-flex align-items-center mb-sm-24">
        {{-- <a href="" class="auth-back">
            <i class="iconly-Light-ArrowLeft"></i>
        </a> --}}
        <h1 class="mb-0">Login</h1>
    </div>
    <p class="mt-sm-8 mt-sm-0 text-black-60">Welcome back, please login to your account.</p>

    <form class="mt-16 mt-sm-32 mb-8" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-16">
            <label for="email" class="form-label">Email :</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror    

            <!-- <label for="loginEmail" class="form-label">Email :</label>
            <input type="email" class="form-control" id="loginEmail"> -->
        </div>

        <div class="mb-16">
        <label for="password" class="form-label">Password :</label>
            <input id="mypassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- <label for="loginPassword" class="form-label">Password :</label>
            <input type="password" class="form-control" id="loginPassword"> -->
        </div>

        <div class="row align-items-center justify-content-between mb-16">
            <div class="col hp-flex-none w-auto">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label ps-4" for="exampleCheck1">Remember me</label>
                </div>
            </div>

            <!-- <div class="col hp-flex-none w-auto">
                <a class="hp-button text-black-80 hp-text-color-dark-40" href="auth-recover.html">Forgot
                    Password?</a>
            </div> -->
        </div>

        <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
        </button>

        <!-- <button type="submit" class="btn btn-primary w-100">
            <a href="index.html" class="d-block w-100" style="color: inherit;">Sign in</a>
        </button> -->
    </form>
</div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
</div> -->
@endsection


