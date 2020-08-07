@extends('layouts.layout')

@section('links')
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
@endsection

@section('content')

@php use Overtrue\LaravelShoppingCart\Facade as PurchaseCart; @endphp

    <div id="content-wrapper" style="background: #ccc;">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-money-bill-alt fa-lg"></i> <b>PURCHASES ORDER</b>
                </li>
            </ol>
            <br>


         {{--   Display Vendor information--}}

            <h2 class="text-center text-success font-weight-bold">{{ strtoupper(strtolower($vendor->company))}}</h2>
            <h6 class="text-center text-dark">{{ $vendor->company_address }}</h6>
            <h6 class="text-center text-dark">{{ $vendor->phone }}</h6>
            <br>

            <div class="container-fluid"> <!-- Form Container-->
                <div class="row">
                    <div class="col col-sm-12 col-md-8 col-lg-6">


            @php
           $items =  \App\Product::all();
            @endphp
                        <!-- Get List of Products into select option tags -->
        {!! Form::open(['method'=>'POST', 'action'=>'admin\AdminCartController@purchase']) !!}

        <select name="product" class="selectpicker form-control" data-container="body" data-live-search="true" title="Select a Product" data-hide-disabled="true" required>
            @foreach($items as $item)
        <option value="{{ $item->id }}">{{ $item->brand }} | {{ $item->name }}</option>;
            @endforeach

        </select> <br> <br>


        <div class="container-fluid"> <!-- container for price, payment and qty -->
            <div class="row">

        <div class="col">
            <label><b>Price</b></label>

            <div class="input-group"  style="padding-bottom: 7px;">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-danger"><b>GH₵</b></span>
                </div>
                <input type="number" name="price" class="form-control" step="0.01" min="0" style="width: 120px !important;" autocomplete="off" required>
            </div>


        <label><b>Qty</b></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text text-white bg-success"><b>Qty</b></span>
            </div>
            <input type="number" name="qty" class="form-control" value="1" min="1" style="width: 120px !important;" autocomplete="off" required>
        </div>

            <input type="hidden" name="vendor" value="{{ $vendor->id }}">

    </div>

    <div class="col"> <!-- col for Payment method -->
        <label style="padding-bottom: 5px;"><b>Payment Method</b></label> <br>
        <div class="input-group">
            <div class="custom-control custom-switch" style="font-weight: bold;">
                <input type="radio" class="custom-control-input" id="switch1" name="payment_method" value="cash" checked>
                <label class="custom-control-label" for="switch1">Cash</label>
            </div>

            &nbsp; &nbsp; &nbsp;
            <div class="custom-control custom-switch" style="font-weight: bold;">
                <input type="radio" class="custom-control-input" id="switch2" name="payment_method" value="credit">
                <label class="custom-control-label" for="switch2">Credit</label>
            </div>
        </div>
        <br><br>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white"><b>Status</b></span>
            </div>
            <select name="status" class="form-control" required>
                <option value="open">Open</option>
                <option value="received">Received</option>
            </select>
        </div>



                </div>  <!-- col for Payment method -->
            </div>
        </div> <!-- container for price, payment and qty -->

        <br><br>
        {!! Form::submit('Add', ['class'=>'btn btn-primary btn-block']) !!}

    {!! Form::close() !!}

                    </div>
                    <div class="col"></div>
                </div>

            </div>    <!-- Form Container-->


            <br>

        {{--   Display ongoing purchases in table       --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-dark">
                    <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>

                   @if(!PurchaseCart::isEmpty())
                   @foreach(PurchaseCart::all() as $purchase)

           <tr>
               <td>{{ $purchase->product->brand }}</td>
               <td>{{ $purchase->name }}</td>
               <td>{{ $purchase->price }}</td>
               <td>
                   {!! Form::open(['method'=>'POST', 'action'=>['admin\AdminCartController@purchase_modify', $purchase->rawId()]]) !!}
                   {!! Form::number('qty', $purchase->qty, ['class'=>'form-control', 'style'=>'max-width: 100px', 'autocomplete'=>'off', 'onchange'=>'form.submit();']) !!}
                   {!! Form::close() !!}
               </td>
               <td>{{ $purchase->total }}</td>

               <td>
                   {!! Form::open(['method'=>'POST', 'action'=>['admin\AdminCartController@purchase_remove', $purchase->rawId() ]]) !!}
                   <button type="submit" class="btn btn-danger btn-sm" href=""><i class="fas fa-trash-alt"></i></button>
                   {!! Form::close() !!}
               </td>
           </tr>

                   @endforeach



                   <tr>
                       <td colspan="4" style="text-align: right;"><b>Total: </b></td>
                       <td><b>GH₵ {{ PurchaseCart::total() }}</b></td>
                   </tr>

                   @endif

                    </tbody>

                </table>
            </div>
            <br>

@if(!PurchaseCart::isEmpty())
    <a href="{{ route('print.purchase', $vendor->id) }}"><button class="btn btn-primary">Make Purchase</button></a>
@endif


@endsection


@section('scripts')

<script src="{{ asset('js/bootstrap-select.js') }}"></script>

                <script>
                    $(function () {
                        $('.selectpicker').selectpicker();
                    })
                </script>
@endsection
