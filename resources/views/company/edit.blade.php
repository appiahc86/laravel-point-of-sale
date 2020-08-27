@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white"><b><span class="fas fa-home"></span> Modify Shop Details</b></div>

                    <div class="card-body">
{{--                        <form method="POST" action="{{ route('store-company') }}" class="myForm">--}}
                            {!! Form::model($company,['method'=>'PATCH', 'action'=>['CompanyController@update', $company->id], 'class'=>'myForm']) !!}


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right"><b>Address</b></label>

                                <div class="col-md-6">
                                    {!! Form::text('address', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right"><b>Contact</b></label>

                                <div class="col-md-6">
                                    {!! Form::text('contact', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block prev" value="Save">
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
