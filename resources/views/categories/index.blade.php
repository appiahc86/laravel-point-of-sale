@extends('layouts.layout')

@section('links')
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endsection

@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">

            <li class="breadcrumb-item" style="font-size: 1.4em;">
                <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>PRODUCT CATEGORY</b>
            </li>
        </ol>
        <br><br>

        <a href="/"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>
        <a href="#addcategory" data-toggle="modal"><button class="btn btn-success">Add Category</button></a>


        <br><br>

        <!-- DataTables -->

        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>

                    <th>CATEGORY NAME</th>
                    <th></th>
                    <th></th>

                </tr>
                </thead>
                <tfoot>
                <tr>

                    <th style="width: 80%;">CATEGORY NAME</th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>

                @foreach($categories as $category)
                <tr>

                <td>{{$category->name}}</td>

                <td>
                    <a href="#del{{$category->id}}" data-toggle="modal">
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                    </a>

                </td>


                <td>
                    <a data-toggle="modal" href="#edit{{$category->id}}">
                        <button class="btn btn-success btn-sm"><i class="fas fa-pen"></i> Edit</button>
                    </a>
                </td>





                    <!--  Modal for deleting category-->
                    <div class="modal fade" id="del{{$category->id}}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
                        <br><br><br><br><br><br><br>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center text-danger" id="exampleModalLabel"><i class="fas fa-trash-alt"></i><span class="text-danger"> Delete This Category</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">


                                    <p class="text-dark">Are you sure you want to delete <b>{{$category->name}}</b></p>
                                </div>
                    <div class="modal-footer">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['admin\CategoriesController@destroy', $category->id]]) !!}
                         {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick'=>"this.style.display='none';"]) !!}
                        {!! Form::close() !!}
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>

                            </div>
                        </div>
                    </div>




                    <!--   Modal for Editing Category-->
                    <div class="modal fade" id="edit{{$category->id}}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <br>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-pen"></i><span class="text-info"> Edit This Category</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

        <div class="modal-body">

        {!! Form::model($category,['method'=>'PATCH', 'action'=>['admin\CategoriesController@update', $category->id]]) !!}
            <label>Category Name</label>
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Category Name', 'autocomplete'=>'off', 'required', 'min'=>3]) !!}

        </div>

        <div class="modal-footer">
            <button type="submit" name="save_edit_category" class="btn btn-primary"><i class="fas fa-chevron-circle-down"></i> Save</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>

        {!! Form::close() !!}

                            </div>
                        </div>
                    </div>



                </tr>

                @endforeach


                </tbody>
            </table>
        </div>











        <!--   Modal for Adding new Category-->
        <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <br>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-plus"></i><span class="text-info"> Add New Category</span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                      {!! Form::open(['method'=>'post', 'action'=>'admin\CategoriesController@store', 'class'=>"myForm"]) !!}
                            <label>Category Name</label>
                            <input name="name" type="text" minlength="3" class="form-control" placeholder="Category Name" autocomplete="off" required>
                    </div>

                    <div class="modal-footer">
{{--                        <button type="submit" name="save_cat" id="addCategory" class="btn btn-primary">Save</button>--}}
                        <input type="submit" name="save_cat" id="addCategory"  class="btn btn-primary prev" value="Save">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>

                    {!! Form::close() !!}

                </div>
                </div>
            </div>



@endsection

@section('scripts')
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
@endsection
