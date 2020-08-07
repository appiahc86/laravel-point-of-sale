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
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>PRODUCTS</b>
                </li>
            </ol>
            <br><br>


<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-7 col-lg-7">
            <b style="font-size: 1.3em;">Products Below the Quantity Of 5 </b><b style="color: red; font-size: 1.4em;">[{{ $less_count}}]</b>
        </div>

        <div class="col-sm-12 col-md-5 col-lg-5">
            <button style="float: right;" data-toggle="modal" data-target="#addproduct" class="btn btn-primary" href=""><i class="fas fa-arrow-alt-circle-down fa-lg"></i> Add New Product</button>
        </div>

    </div>

</div>



            <br><br>

        <!-- DataTables -->

            <div class="table-responsive">
                <table class="table table-hover table-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>CATEGORY</th>
                        <th>BRAND</th>
                        <th>ITEM NAME</th>
                        <th>COST PRICE</th>
                        <th>WHOLESALE PRICE</th>
                        <th>RETAIL PRICE</th>
                        <th>PROFIT</th>
                        <th>QTY</th>
                        <th>DATE ADDED</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>

                       @foreach($products as $product)
                           @php
                               $firstdate = strtotime($product->created_at);
                               $date = date('d-M-Y', $firstdate);
                           @endphp

                   <tr @if($product->qty < 5) style="background: rgba(135,26,49,0.45);" @endif>
                    <td>{{$product->category}}</td>
                    <td>{{$product->brand}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{number_format($product->cost_price, 2)}}</td>
                    <td>{{number_format($product->wholesale_price, 2)}}</td>
                    <td>{{number_format($product->selling_price, 2)}}</td>
                    <td>{{number_format($product->profit, 2)}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{ $date }}</td>

                    <td>
                        <a data-toggle="modal" href="#edit{{$product->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>

                       <td>
                           <a href="#del{{$product->id}}" data-toggle="modal" class="btn btn-danger btn-sm">
                               <i class="fas fa-times fa-lg"></i>
                           </a>
                       </td>




    <!--  Modal for deleting product-->
    <div class="modal fade" id="del{{$product->id}}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
        <br><br><br><br><br><br><br>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-danger" id="exampleModalLabel"><i class="fas fa-trash-alt"></i><span class="text-danger"> Delete This Product</span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">


                    <p class="text-dark">Are you sure you want to delete <b>{{$product->brand}} {{$product->name}}?</b></p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['admin\ProductsController@destroy', $product->id]]) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>



        <!--   Modal for Editing products-->
        <div class="modal fade" id="edit{{$product->id}}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <br>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-pen"></i><span class="text-info"> Edit This Product</span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                <div class="modal-body">
        @php
          $categories = \App\Category::pluck('name', 'name')->all();
        @endphp

        {!! Form::model($product,['method'=>'PATCH', 'action'=>['admin\ProductsController@update', $product->id]]) !!}

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Category</b></span>
            </div>
           {!! Form::select('category', array(''=>'Select Category') + $categories, null, ['class'=>'form-control']) !!}
        </div>  <br>



    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Brand</b></span>
        </div>
        {!! Form::text('brand', null, ['class'=>'form-control', 'placeholder'=>'Brand']) !!}
    </div>  <br>


   <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Product Name</b></span>
        </div>
   {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Product Name', 'autocomplete'=>'off', 'required']) !!}
   </div>  <br>


    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Cost Price GH₵</b></span>
        </div>
    {!! Form::number('cost_price', null, ['class'=>'form-control', 'step'=>0.01, 'min'=>0, 'placeholder'=>'Cost Price', 'required']) !!}
    </div>  <br>



    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Wholesale Price GH₵</b></span>
        </div>
        {!! Form::number('wholesale_price', null, ['class'=>'form-control', 'step'=>0.01, 'min'=>0, 'placeholder'=>'Wholesale Price', 'required']) !!}
    </div>  <br>


    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Retail Price GH₵</b></span>
        </div>
        {!! Form::number('selling_price', null, ['class'=>'form-control text-success', 'step'=>0.01, 'min'=>0, 'placeholder'=>'Retail Price', 'required']) !!}
    </div>  <br>



    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Profit GH₵</b></span>
        </div>
        {!! Form::number('profit', null, ['class'=>'form-control', 'step'=>0.01, 'min'=>0, 'placeholder'=>'Profit', 'required', 'readonly']) !!}
    </div> <br>



    <label>Qty</label>
    <label style="float: right;">Add Qty</label>

    <div class="input-group">
        {!! Form::number('qty', null, ['style'=>'width: 70% !important;', 'class'=>'form-control', 'placeholder'=>'Quantity', 'autocomplete'=>'off', 'required']) !!}
        {!! Form::number('addqty', 0, ['class'=>'form-control', 'min'=>0, 'autocomplete'=>'off']) !!}
    </div>



        <div class="modal-footer">
            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
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



            <!--   Modal for Adding new product-->
            <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <br>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-plus"></i><span class="text-info"> Add New Product</span></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
             @php
             $all_categories = \App\Category::pluck('name','name')->all();
             @endphp

    {!! Form::open(['method'=>'post', 'action'=>'admin\ProductsController@store']) !!}


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Category</b></span>
            </div>
            {!! Form::select('category', array(''=>'--Select Category') + $all_categories, null, ['class'=>'form-control'] ) !!}
        </div><br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Brand</b></span>
            </div>
            {!! Form::text('brand', null, ['class'=>'form-control', 'placeholder'=>'Brand']) !!}
            </div><br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Product Name</b></span>
            </div>
        {!! Form::text('product_name', null, ['class'=>'form-control', 'placeholder'=>'Product Name', 'autocomplete'=>'off', 'required']) !!}
        </div><br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Cost Price GH₵</b></span>
            </div>
         {!! Form::number('cost_price', null, ['class'=>'form-control', 'min'=>0, 'step'=>0.01, 'id'=>'cost', 'placeholder'=>'Cost Price', 'autocomplete'=>'off', 'required']) !!}
        </div><br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Wholesale Price GH₵</b></span>
            </div>
         {!! Form::number('wholesale_price', null, ['class'=>'form-control', 'min'=>0, 'step'=>0.01, 'id'=>'wholesale', 'placeholder'=>'Wholesale Price', 'autocomplete'=>'off', 'required']) !!}
        </div> <br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Retail Price GH₵</b></span>
            </div>
            {!! Form::number('retail_price', null, ['class'=>'form-control text-success', 'min'=>0, 'step'=>0.01, 'id'=>'selling', 'placeholder'=>'Retail Price', 'autocomplete'=>'off', 'required']) !!}
        </div><br>


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><b>Profit GH₵</b></span>
            </div>
            {!! Form::number('profit', null, ['class'=>'form-control', 'min'=>0, 'step'=>0.01, 'id'=>'profit', 'placeholder'=>'Profit', 'readonly']) !!}
        </div><br>



      <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><b>Qty</b></span>
        </div>
          {!! Form::number('quantity', 0, ['class'=>'form-control', 'min'=>0, 'placeholder'=>'Quantity', 'autocomplete'=>'off', 'required']) !!}
      </div><br>


        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-down"></i> Save</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>

    {!! Form::close() !!}


                    </div>
                </div>
            </div>
            </div>





            @section('scripts')

            <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
             <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
             <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
             <script src="{{ asset('js/toastr.js') }}"></script>

                <script>

                    $(function () {

                        // Checking profit for new products
                        $("#cost").keyup(function () {

                            var cost = $("#cost").val();
                            var selling = $("#selling").val();

                            $("#profit").val(selling - cost);

                        });


                        $("#selling").keyup(function () {

                            var cost = $("#cost").val();
                            var selling = $(this).val();

                            $("#profit").val(selling - cost);

                        });  //  End of Checking profit for new products

                    });

                </script>

            @endsection


@endsection
