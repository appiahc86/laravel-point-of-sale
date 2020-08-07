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
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>OPEN PURCHASES</b>
                </li>
            </ol>
            <br class="hideme">
            <h1 class="text-center"><b>OPEN PURCHASES</b></h1>

            <button id="print" class="btn btn-success ml-4"><i class="fas fa-print fa-lg"></i> Print</button>

            <br><br>

            <div class="row">

                <div class="col">

                    <p><b>{{ date('d-M-Y') }}</b></p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-dark table-hover">
                            <thead>
                            <tr>
                                <th>DATE</th>
                                <th>VENDOR</th>
                                <th>CATEGORY</th>
                                <th>BRAND</th>
                                <th>PRODUCT NAME</th>
                                <th>PRICE</th>
                                <th>QTY</th>
                                <th>PAYMENT METHOD</th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>


                            <tbody>

                            @if(!empty($purchases))

                                @foreach($purchases as $purchase)
                                    @php
                                        $firstdate = strtotime($purchase->created_at);
                                        $date = date('d-M-Y', $firstdate);
                                    @endphp
                                    <tr>

                                        <td>{{ $date }}</td>
                                        <td>{{ $purchase->vendor }}</td>
                                        <td>{{ $purchase->category }}</td>
                                        <td>{{ $purchase->brand }}</td>
                                        <td>{{ $purchase->name }}</td>
                                        <td>{{ number_format($purchase->price, 2) }}</td>
                                        <td>{{ $purchase->qty }}</td>
                                        <td>{{ $purchase->payment_method }}</td>
                                        <td>{{ number_format($purchase->cost, 2) }}</td>

                                    </tr>


                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <br>

            @endif


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
