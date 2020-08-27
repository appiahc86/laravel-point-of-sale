@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white"><b><span class="fas fa-home"></span> Please Add Shop Details</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store-company') }}" class="myForm">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}"
                                           required autocomplete="name"
                                           autofocus
                                           placeholder="eg. My Shop Enterprise"
                                    >

                                    @error('name')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right"><b>Address</b></label>

                                <div class="col-md-6">
                                    <input id="address"
                                           type="text"
                                           class="form-control @error('address') is-invalid @enderror"
                                           name="address"
                                           value="{{ old('address') }}"
                                           required
                                           autocomplete="off"
                                           placeholder="eg. Adum, Near Commercial Bank"
                                    >

                                    @error('address')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right"><b>Contact</b></label>

                                <div class="col-md-6">
                                    <input id="contact"
                                           type="text"
                                           class="form-control @error('contact') is-invalid @enderror"
                                           name="contact"
                                           value="{{ old('contact') }}"
                                           required
                                           autocomplete="off"
                                           placeholder="eg. 02444445556 / 0976756461"
                                    >

                                    @error('contact')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block prev" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
