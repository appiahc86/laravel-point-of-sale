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
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>PURCHASES REPORT</b>
                </li>
            </ol>
            <br class="hideme">
            <h1 class="text-center"><b>PURCHASES REPORT</b></h1>

            <button id="print" class="btn btn-success ml-4"><i class="fas fa-print fa-lg"></i> Print</button>

            <div class="container">
                <div class="row">


                    {!! Form::open(['method'=>'POST', 'action'=>'ReportController@purchases_by_date', 'class'=>'m-auto']) !!}
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

            @if(!empty($purchases))

                <div class="row">

                    <div class="col">



                        <p>
                            From <b>{{ $from }}</b> to <b>{{ $to }}</b>
                        </p>


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
                                    <th>TOTAL</th>
                                    <th>PAYMENT METHOD</th>

                                </tr>
                                </thead>


                                <tbody>

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
                                        <td>{{ number_format($purchase->cost, 2) }}</td>
                                        <td>{{ $purchase->payment_method }}</td>
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
