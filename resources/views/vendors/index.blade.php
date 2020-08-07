@extends('layouts.layout')


@section('links')
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">    
@endsection

@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>VENDORS</b>
                </li>
            </ol>
            <br><br>

            <a class="align-content-end" href="#addvendor" data-toggle="modal"><button class="btn btn-primary">Add Vendor</button></a>

            <br><br>

            <!-- DataTables -->

            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>COMPANY</th>
                        <th>CONTACT PERSON</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th></th>
                        <th></th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>COMPANY</th>
                        <th>CONTACT PERSON</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @if($vendors)
                        @foreach($vendors as $vendor)

                    <tr>

                    <td>{{ strtoupper($vendor->company) }}</td>
                    <td>{{ $vendor->contact_person }}</td>
                    <td>{{ $vendor->phone }}</td>
                    <td>{{ $vendor->company_address }}</td>


                    <td>
                        <a data-toggle="modal" href="#del{{ $vendor->id }}">
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </a> &nbsp;
                    </td>


                    <td>
                        <a data-toggle="modal" href="#edit{{ $vendor->id }}" >
                            <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>



                        <!--  Modal for deleting Vendor-->
                        <div class="modal fade" id="del{{ $vendor->id }}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
                            <br><br><br><br><br><br><br>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center text-danger" id="exampleModalLabel"><i class="fas fa-trash-alt"></i><span class="text-danger"> Delete This Vendor</span></h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <p class="text-dark">Are you sure you want to delete <b>{{ $vendor->company }}?</b></p>
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['admin\VendorsController@destroy', $vendor->id]]) !!}
                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <!--   Modal for Editing vendor-->
    <div class="modal fade" id="edit{{ $vendor->id }}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <br>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-pen"></i><span class="text-info"> Edit This Vendor</span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">


{!! Form::model($vendor,['method'=>'PATCH', 'action'=>['admin\VendorsController@update', $vendor->id]]) !!}

    {!! Form::label('company', 'Name Of Company') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-home"></i></span>
        </div>
        {!! Form::text('company', null, ['class'=>'form-control', 'placeholder'=>'Company', 'autocomplete'=>'off', 'required']) !!}
    </div>


    {!! Form::label('contact_person', 'Contact Person') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        {!! Form::text('contact_person', null, ['class'=>'form-control', 'placeholder'=>'Name Of Person', 'autocomplete'=>'off', 'required']) !!}
    </div>



    {!! Form::label('phone', 'Phone') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Phone', 'autocomplete'=>'off', 'required']) !!}
    </div>


        {!! Form::label('company_address', 'Address') !!}

        {!! Form::textarea('company_address', null, ['class'=>'form-control', 'cols'=>10, 'rows'=>'5','required','autocomplete'=>'off']) !!}

    </div>

        <div class="modal-footer">
            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>

        {!! Form::close() !!}

    </div>
 </div>
</div>  <!--   End of Modal -->


    </tr>


        @endforeach
            @endif



        </tbody>
    </table>
</div>











            <!--   Modal for Adding new Vendor-->
    <div class="modal fade" id="addvendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-plus"></i><span class="text-info"> Add New Vendor</span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

<div class="modal-body">
    {!! Form::open(['method'=>'POST', 'action'=>'admin\VendorsController@store']) !!}

    {!! Form::label('company', 'Name Of Company') !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-home"></i></span>
    </div>
    {!! Form::text('company', null, ['class'=>'form-control', 'placeholder'=>'Company', 'autocomplete'=>'off', 'required']) !!}
</div>

    {!! Form::label('contact_person', 'Contact Person') !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
    </div>
    {!! Form::text('contact_person', null, ['class'=>'form-control', 'placeholder'=>'Name Of Person', 'autocomplete'=>'off', 'required']) !!}
</div>


    {!! Form::label('phone', 'Phone') !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
    </div>
    {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Phone', 'autocomplete'=>'off', 'required']) !!}
</div>


{!! Form::label('address', 'Address') !!}
{!! Form::textarea('address', null, ['class'=>'form-control', 'cols'=>10, 'rows'=>5, 'maxlength'=>255, 'required']) !!}

</div>

<div class="modal-footer">
    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
</div>

{!! Form::close() !!}


        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/toastr.js') }}"></script>
@endsection