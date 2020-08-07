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
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>PRODUCTS LIST</b>
                </li>
            </ol>
            <br class="hideme">
            <h1 class="text-center"><b>PRODUCTS LIST</b></h1>

            <button id="print" class="btn btn-success ml-4"><i class="fas fa-print fa-lg"></i> Print</button>

            <br><br>

            <div class="row">

                <div class="col">

                    <p><b>{{ date('d-M-Y') }}</b></p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-dark table-hover">
                            <thead>
                            <tr>
                                <th>DATE ADDED</th>
                                <th>CATEGORY</th>
                                <th>BRAND</th>
                                <th>NAME</th>
                                <th>COST PRICE</th>
                                <th>WHOLESALE</th>
                                <th>RETAIL</th>
                                <th>QTY</th>
                                <th>PROFIT</th>
                            </tr>
                            </thead>


        <tbody>

        @if(!empty($products))

            @foreach($products as $product)
                <tr>
                    @php
                    $firstdate = strtotime($product->created_at);
                    $date = date('d-M-Y', $firstdate);
                    @endphp

                    <td>{{ $date }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->cost_price, 2) }}</td>
                    <td>{{ number_format($product->wholesale_price, 2) }}</td>
                    <td>{{ number_format($product->selling_price, 2) }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ number_format($product->profit, 2) }}</td>

                </tr>


            @endforeach


        </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <br>

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
