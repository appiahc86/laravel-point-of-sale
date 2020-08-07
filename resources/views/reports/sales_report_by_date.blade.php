@extends('layouts.layout')

@section('links')
<link rel="stylesheet"  href="{{ asset('jquery-ui/jquery-ui.css') }}">
@endsection

@section('content')

<style>

    @media print{
        .table-bordered td, .table-striped td{
            border: 1px solid black !important;
            font-size: 1.1em !important;
            color: black !important;
        }

        .table-bordered th, .table-striped th{
            border: 1px solid black !important;
            font-size: 1.2em !important;
        }
    }

</style>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">

            <li class="breadcrumb-item" style="font-size: 1.4em;">
                <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>SALES REPORT</b>
            </li>
        </ol>
        <br class="hideme">
        <h1 class="text-center"><b>SALES REPORT</b></h1>

        <button id="print" class="btn btn-success ml-4"><i class="fas fa-print fa-lg"></i> Print</button>

        <div class="container">
            <div class="row">


                    {!! Form::open(['method'=>'POST', 'action'=>'ReportController@sales_by_date', 'class'=>'m-auto']) !!}
                    <div class="input-group">


                        <div class="input-group-prepend">
                            <span class="input-group-text text-white bg-dark"><b>From</b></span>
                        </div>
                        <input type="text" name="from" class="form-control mydate" readonly="yes">&nbsp;
                        &nbsp;

                        <div class="input-group-prepend">
                            <span class="input-group-text text-white bg-dark"><b>To</b></span>
                        </div>
                        <input type="text" name="to" class="form-control mydate" readonly="yes"> &nbsp;
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>


                    </div>
               {!! Form::close() !!}

            </div>

        </div>
        <br>

        @if(!empty($orders))

        <div class="row">

            <div class="col">



                <p>
                   From <b>{{ $from }}</b> to <b>{{ $to }}</b>
                </p>


                <div class="table-responsive">
                    <table class="table table-dark table-striped table-dark table-hover">
                        <thead>
                        <tr>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>ITEM NAME</th>
                            <th>LEVEL</th>
                            <th>COST PRICE</th>
                            <th>SELLING PRICE</th>
                            <th>QTY</th>
                            <th>DISCOUNT</th>
                            <th>TOTAL</th>
                            <th>PROFIT</th>

                        </tr>
                        </thead>

                        @php
                        $tot_discount = array();
                        $tot_amount = array();
                        $tot_profit = array();

                        @endphp

                        <tbody>

                  @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->category }}</td>
                            <td>{{ $order->brand }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ ucfirst(strtolower($order->price_level)) }}</td>
                            <td>{{ number_format($order->cost_price, 2) }}</td>
                            <td>{{ number_format($order->selling_price, 2) }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ number_format($order->discount, 2) }}</td>
                            <td>{{ number_format($order->amount, 2) }}</td>
                            <td>{{ number_format($order->profit, 2) }}</td>
                        </tr>
                      @php
                        array_push($tot_discount, $order->discount);
                        array_push($tot_amount,   $order->amount);
                        array_push($tot_profit,   $order->profit);
                      @endphp

                  @endforeach


                        </tbody>

                    </table>
                </div>
            </div>

        </div>
            <br>
            @php
                $total_discount = array_sum($tot_discount);
                $total_amount = array_sum($tot_amount);
                $total_profit = array_sum($tot_profit);
            @endphp


        <p style="font-size: 1.4em;">
            <span><b>TOTAL SALES :</b> </span><span class="text-danger"><b>GH₵ {{ number_format($total_amount, 2) }}</b></span><br>
            <span><b>TOTAL PROFIT :</b> </span><span><b>GH₵ {{ number_format($total_profit, 2) }}</b></span><br>
            <span><b>TOTAL DISCOUNT :</b> </span><span><b>GH₵ {{ number_format($total_discount, 2) }}</b></span><br>
        </p>
        @endif
        <br><br>


@endsection


@section('scripts')

      <script src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>
      
        <script>
            $(".mydate").datepicker({dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});

            $("#print").click(function () {
                $(".sidebar").hide();
                $("#print").hide();
                $(".breadcrumb").hide();
                $(".hideme").hide();
                $("form").hide();
                $(".sticky-footer").hide();
                window.print();
                location.reload();
            })
        </script>

@endsection
