@extends('layouts.app')

<style>

    .my-title {
        color: #fff;
        font-size: 6em;
        font-weight: bold;
        font-family: "Times New Roman", "Marlett", Arial, Helvetica, sans-serif;
        text-shadow:
            0 1px 0 #ccc,
            0 2px 0 #c9c9c9,
            0 3px 0 #bbb,
            0 4px 0 #b9b9b9,
            0 5px 0 #aaa,
            0 6px 1px rgba(0,0,0,.1),
            0 0 5px rgba(0,0,0,.1),
            0 1px 3px rgba(0,0,0,.3),
            0 3px 5px rgba(0,0,0,.2),
            0 5px 10px rgba(0,0,0,.25),
            0 10px 10px rgba(0,0,0,.2),
            0 20px 20px rgba(0,0,0,.15);
    }

    .my-title {
        text-align: center;
    }

</style>
<!--
<a href="{{ route('close-app') }}" class="btn-lg btn-danger mr-4 text-white" style="float: right;">
    <b><span class="fas fa-times"></span></b>
</a>  -->


@section('header')
    <div class="my-title mt-5">INNOCENT ENTERPRISE</div>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white"><b><span class="fas fa-lock"></span> Login</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="myForm">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right"><b>UserName</b></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="shadow form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  autofocus>

                                @error('username')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>Password</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="shadow form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--     REMEMBER ME CHECKBOX             --}}
                        <div class="form-group row" style="display: none;">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg prev">
                                    <b>Login</b>
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

