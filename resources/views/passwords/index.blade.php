@extends('layouts.app')

@section('content')


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white"><b><span class="fas fa-lock"></span> Reset Password</b></div>

                    <div class="card-body">

                        {!! Form::open(['method'=>'POST', 'action'=>'PasswordController@reset']) !!}

                        <div class="form-group row">
                            <label for="current" class="col-md-4 col-form-label text-md-right"><b>Current Password</b></label>

                            <div class="col-md-6">
                                <input id="Current_Password" type="password" class="form-control @if(Session::has('error')) is-invalid @endif" name="Current_Password" value="{{ old('Current_Password') }}" required autocomplete="off" autofocus>

                                @if(Session::has('error'))
                                    <span class="invalid-feedback error-message" role="alert">
                                       <strong>{{ session('error') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>New Password</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>Confirm Password</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <b>Reset</b>
                                </button>
                                <span>
                                     <a href="{{ url('/') }}" class="btn btn-secondary btn-lg">
                                    <b>Cancel</b>
                                </a>
                                </span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


