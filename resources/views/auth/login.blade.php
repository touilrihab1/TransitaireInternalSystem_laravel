@extends('layouts.app')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

    .log {
        width: 90%;
        max-width: 30rem;
        height: 90%;
        max-height: 90%;
        margin: 5% auto;
        background-color: rgb(255, 255, 255);
        padding: 2.5rem 0;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .card {
        background-color: transparent !important;
        border: none !important;
    }

    .log h2 {
        text-align: center;
        color: #952429;
        font-weight: bold;
        font-size: 1.625rem;
        margin-bottom: 1.875rem;
    }

    .log .input-cont {
        position: relative;
        margin: 0 3.125rem 3.75rem;
    }

    .log .input-cont:last-of-type {
        margin-bottom: 1.875rem;
    }

    .log .input-cont input {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 2.5rem;
        outline: none;
        color: #212121;
        font-size: 1rem;
        font-weight: 400;
        background: transparent !important;
        border: none;
    }

    .log .input-cont input:focus {
        outline: none;
        background: transparent !important;
    }

    .log .input-cont input:active {
        outline: none;
        background: transparent !important;
    }

    .log .input-cont label {
        position: absolute;
        color: #948c8c;
        top: 0;
        left: 0;
        line-height: 2.5rem;
        -webkit-transition: .3s;
        -moz-transition: .3s;
        -o-transition: .3s;
        transition: .3s;
    }

    .log .input-cont input:focus+label {
        margin-top: -0.125rem;
        -webkit-transform: scale(.8);
        -moz-transform: scale(.8);
        -o-transform: scale(.8);
        transform: scale(.8);
        color: #bdbdbd;
    }

    .log .border1,
    .log .border2 {
        position: absolute;
        height: 0.125rem;
        background-color: #9E9E9E;
        left: 0;
        bottom: 0;
        width: 100%;
    }

    .log .border1::after,
    .log .border1::before,
    .log .border2::after,
    .log .border2::before {
        content: "";
        position: absolute;
        bottom: 0;
        width: 0;
        height: 0.125rem;
        -webkit-transition: .5s;
        -moz-transition: .5s;
        -o-transition: .5s;
        transition: .5s;
    }

    .log .border1::after,
    .log .border2::after {
        right: 50%;
        background-color: #952429;
    }

    .log .border1::before,
    .log .border2::before {
        left: 50%;
        background-color: #952429;
    }

    .log .input-cont input:focus~.border1::after,
    .log .input-cont input:focus~.border1::before,
    .log .input-cont input:focus~.border2::after,
    .log .input-cont input:focus~.border2::before {
        width: 50%;
    }

    .log .check,
    .log a {
        float: left;
        width: calc(50% - 3.125rem);
        display: block;
        font-size: 0.75rem;
        margin-bottom: 1.875rem;
    }

    .log .check {
        margin-left: 3.125rem;
    }

    .log a {
        text-align: right;
        text-decoration: none;
        color: #952429;
    }

    .log a:hover {
        text-decoration: underline;
        color: #F00;
    }

    .log form input[type="submit"] {
        display: block;
        margin: 0 auto 1.25rem;
        border: 0.125rem solid transparent;
        padding: 0.3125rem 1.25rem;
        font-size: 1.25rem;
        cursor: pointer;
        color: #952429;
        -webkit-transition: .5s;
        -moz-transition: .5s;
        -o-transition: .5s;
        transition: .5s;
    }

    .log form input[type="submit"]:focus {
        outline: none;
    }

    .log form input[type="submit"]:hover {
        border: 0.125rem solid #952429;
    }

    /* Responsive styles */
    @media (max-width: 48rem) {
        .log {
            width: 90%;
            max-width: 20rem;
        }
    }

    @media (max-width: 36rem) {
        .log {
            width: 90%;
            max-width: 15rem;
        }
    }
</style>

@section('content')
<div class="container">
    <div class="card">
        <div class="log">
            <h2>Transit In Time</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-cont">
                    <br>
                    <br>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">Username</label>
                    <br>
                    <div class="border1"></div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-cont">
                    <br>
                    <br>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <label for="password">Password</label>
                    <br>
                    <div class="border2"></div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <span class="check">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">&nbsp;Remember Me</label>
                </span>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot Password</a>
                @endif

                <div class="clear"></div>
                <input type="submit" value="Sign In">
            </form>
        </div>
        <br>
    </div>
</div>
</div>

@endsection
