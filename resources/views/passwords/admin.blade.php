@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 mt-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white"><b><span class="fas fa-lock"></span> Reset Password</b></div>

                    <div class="card-body">

                            {!! Form::model($user,['method'=>'PATCH', 'action'=>['admin\UsersController@update', $user->id], 'onsubmit'=>"document.getElementById('resetPass').style.display='none';"]) !!}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="off" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>





                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><b>New Password</b></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                    @error('password')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg" id="resetPass">
                                      <b>Reset</b>
                                    </button>
                                    <span style="float: right;"><a href="{{ url('/') }}" class="btn btn-secondary btn-lg">Cancel</a></span>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
