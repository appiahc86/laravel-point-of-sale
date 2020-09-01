@extends('layouts.layout')

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

            <li class="breadcrumb-item " style="font-size: 1.4em;">
                <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>SALES REPORT</b>
            </li>
        </ol>
        <br class="hideme">
        <h1 class="text-center"><b>DAILY SALES REPORT</b></h1>

        <button id="print" class="btn btn-success ml-4"><i class="fas fa-print fa-lg"></i> Print</button>

        <br><br>

        <div class="row">

            <div class="col">

                <p><b>{{ date('d-M-Y') }}</b></p>

                <div class="table-responsive">
                    <table class="table table-dark table-striped table-dark table-hover">
                        <thead>
                        <tr>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>ITEM NAME</th>
                            <th>COST PRICE</th>
                            <th>LEVEL</th>
                            <th>SELLING PRICE</th>
                            <th>QTY</th>
                            <th>DISCOUNT</th>
                            <th>TOTAL</th>

                            @if(auth()->user()->isAdmin())
                             <th>PROFIT</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($orders))
                            @php
                            $tot_disc = array();
                            $tot_sale = array();
                            $tot_profit = array();
                            @endphp
                            @foreach($orders as $order)
                        <tr>

                            <td>{{ $order->category }}</td>
                            <td>{{ $order->brand }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ number_format($order->cost_price, 2) }}</td>
                            <td>{{ ucfirst(strtolower($order->price_level)) }}</td>
                            <td>{{ number_format($order->selling_price, 2) }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ number_format($order->discount, 2) }}</td>
                            <td>{{ number_format($order->amount, 2) }}</td>

                            @if(auth()->user()->isAdmin())
                            <td>{{ number_format($order->profit, 2) }}</td>
                            @endif

                        </tr>

                                @php
                                 array_push($tot_disc, $order->discount);
                                 array_push($tot_sale, $order->amount);
                                 array_push($tot_profit, $order->profit);
                                @endphp

                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <br>

                    @php
                        $total_discount = array_sum($tot_disc);
                        $total_sales = array_sum($tot_sale);
                         $total_profit = array_sum($tot_profit);
                    @endphp
        <p style="font-size: 1.4em;">
            <span><b>TOTAL SALES :</b> </span><span class="text-danger"><b>GH₵ {{ number_format($total_sales, 2) }}</b></span><br>

            @if(auth()->user()->isAdmin())
            <span><b>TOTAL PROFIT :</b> </span><span><b>GH₵ {{ number_format($total_profit, 2) }}</b></span><br>
            @endif

            <span><b>TOTAL DISCOUNT :</b> </span><span><b>GH₵ {{ number_format($total_discount, 2) }}</b></span><br>
        </p>


        @endif


        <br><br>

@endsection

        @section('scripts')

            <script>


                $(function () {
                    $("#print").click(function () {
                        $(".sidebar").hide();
                        $("#print").hide();
                        $(".breadcrumb").hide();
                        $(".hideme").hide();
                        $("form").hide();
                        $(".sticky-footer").hide();
                        window.print();
                        location.reload();
                    });

                });
            </script>

@endsection
