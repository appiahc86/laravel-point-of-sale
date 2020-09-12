@extends('layouts.layout')

@section('links')
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endsection

@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-money-bill-alt fa-lg"></i> <b>MAKE A SALE</b>
                </li>
            </ol>
            <br><br>

            <a href="/"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>

            <br><br>

            @php
            $products = \App\Product::all();
            @endphp

<div class="container-flex">
{!! Form::open(['method'=>'POST', 'action'=>'CartController@add', 'onsubmit'=>"document.getElementById('addToCart').disabled=true"]) !!}
    <div class="row">

        <div class="col-xl-5 col-lg-12 col-md-12 mb-2">
            <select name="product" class="selectpicker form-control" data-container="body" data-live-search="true" title="Select a Product" data-hide-disabled="true" required>
                @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->brand}} *** {{$product->name}} *** Qty = {{$product->qty}} *** GH₵ {{number_format($product->selling_price, 2)}}</option>
                @endforeach
            </select>
        </div>



        <div class="col-xl-2 col-lg-12 col-md-12 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning text-white"><b>QTY</b></span>
                </div>
                {!! Form::number('qty', 1, ['class'=>'form-control', 'min'=>1, 'autocomplete'=>'off', 'required']) !!}
            </div>
        </div>


        <div class="col-xl-2 col-lg-12 col-md-12 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white"><b>Price Level</b></span>
                </div>
                {!! Form::select('price_level', array('retail'=>'Retail', 'wholesale'=>'Wholesale'), 'retail', ['class'=>'form-control', 'min'=>1, 'autocomplete'=>'off', 'required']) !!}
            </div>
        </div>


        <div class="col-xl-2 col-lg-12 col-md-12 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white"><b>DISC GH₵</b></span>
                </div>
                {!! Form::number('discount', 0, ['class'=>'form-control', 'min'=>0, 'step'=>'0.01', 'autocomplete'=>'off', 'required']) !!}
            </div>
        </div>


        <div class="col-xl-1 col-lg-12 col-md-12 mb-2">
{{--          {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}--}}
            <input type="submit" id="addToCart" title="Add To Cart" value="Add" class="btn-primary form-control" style="max-width: 100px !important;">

        </div>


    </div>
{!! Form::close() !!}
</div>


            <br><br>
@php
use Overtrue\LaravelShoppingCart\Facade as Cart;
@endphp
            <!-- Cart Table -->

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>CATEGORY</th>
                        <th>BRAND</th>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>DISC</th>
                        <th>TOTAL</th>

                        @if(auth()->user()->isAdmin())
                        <th>PROFIT</th>
                        @endif

                        <th></th>
                    </tr>
                </thead>


                    <tbody>

                    @if(!Cart::isEmpty())
                        @foreach(Cart::all() as $product)

    <tr>
        <td>{{ $product->product->category }}</td>
        <td>{{ $product->product->brand }}</td>
        <td>{{ $product->product->name }}</td>
        <td>{{ number_format($product->price, 2) }}</td>

        <td>
            {!! Form::open(['method'=>'POST',
                'action'=>['CartController@modify', $product->rawId()]]) !!}

            <input type="hidden" name="price" value="{{$product->price}}">
            <div style="justify-content: center;" class="input-group">
                <div class="input-group-prepend decrement">
                    <span class="input-group-text"><i class="fas fa-minus"></i></span>
                </div>
                <input type="text" style="max-width: 100px;" class="form-control quantiy" name="qty" value="{{ $product->qty }}" autocomplete="off" onchange="form.submit();">
                <div class="input-group-append increment">
                    <span class="input-group-text"><i class="fas fa-plus"></i></span>
                </div>
            </div>

            {!! Form::close() !!}
        </td>

        <td>{{ number_format($product->discount , 2) }}</td>
        <td>{{ number_format($product->amount, 2) }}</td>

        @if(auth()->user()->isAdmin())
        <td>{{ number_format($product->profit, 2) }}</td>
        @endif

        <td>
            {!! Form::open(['method'=>'POST', 'action'=>['CartController@remove', $product->rawId()]]) !!}
            <button type="submit" onclick=" this.disabled=true; form.submit();" class="btn btn-sm btn-danger text-white" title="Remove Item"><b>X</b></button>
            {!! Form::close() !!}
        </td>


    </tr>

                        @endforeach

                {{--    Calculate Total   --}}
                        @php
                        $calc_total = array();

                        foreach (Cart::all() as $cal){
                            array_push($calc_total, $cal->amount);
                        }
                        $total = array_sum($calc_total);
                        $total = number_format($total, 2);
                        $payment = str_replace(',', '', $total);
                        @endphp



                        <tr class="text-danger" style="background: #c5ecd5; font-size: 2em;">
                            <td colspan="6" style="text-align: right;"><b>Total: </b></td>
                            <td colspan="3"><b>GH₵ {{ $total }}</b></td>

                        </tr>



                    </tbody>
                </table>
            </div>
            <br><br>


    <a href="#take" data-toggle="modal">
        <button class="btn btn-primary"><i class="fas fa-money-bill"></i> Take Payment</button>
    </a>



    <!--  Modal for taking payment-->
<div class="modal fade" id="take" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
                <br><br><br><br><br><br><br>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center text-dark" id="exampleModalLabel"><i class="fas fa-money-bill"></i><span class="text-primary"> Take Payment</span></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                    {!! Form::open(['method'=>'POST', 'action'=>'CartController@pay', 'onsubmit'=>"document.getElementById('paymentBtn').disabled=true"]) !!}


{{--                            <div class="input-group">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>--}}
{{--                                </div>--}}
{{--                                {!! Form::text('cust_name', null, ['class'=>'form-control', 'placeholder'=>'Name of Customer', 'autocomplete'=>'off']) !!}--}}
{{--                            </div>--}}


                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>GH₵</b></span>
                                </div>
                                {!! Form::number('price', $payment, ['class'=>'form-control', 'min'=>$payment]) !!}
                            </div>

                        </div>
                        <div class="modal-footer">

                            {!! Form::submit('Proceed', ['class'=>'btn btn-primary', 'id'=>'paymentBtn']) !!}
{{--                            <input type="submit" value="Proceed" class="btn btn-primary" onsubmit="this.style.display='none'">--}}

                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>

            @endif

@endsection

@section('scripts')
<script src="{{ asset('js/toastr.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script>


        $(function () {

            //selectpicker
            $('.selectpicker').selectpicker();


            //DECREMENT
           $('.decrement').click(function () {
              var decrement = $(this).next();
              decrement.val( +decrement.val() - 1 );
             $(this).parent().parent().submit();
           });



           //INCREMENT
            $('.increment').click(function () {
                var increment = $(this).prev();
                increment.val( +increment.val() + 1 );
                $(this).parent().parent().submit();
            });

        });
    </script>
@endsection
