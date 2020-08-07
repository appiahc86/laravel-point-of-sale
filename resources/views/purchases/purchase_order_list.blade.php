@extends('layouts.layout')

@section('links')
  <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-list-alt fa-lg"></i> <b>PURCHASE ORDER LIST</b> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
                    <span class="text-success successmsg">

                </span>

                </li>
            </ol>
            <br> <br>



            <div class="table-responsive">
                <table class="table table-dark table-striped table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>DATE</th>
                        <th>VENDOR</th>
                        <th>STATUS</th>
                        <th>BRAND</th>
                        <th>PRODUCT NAME</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>COST</th>
                        <th>RECEIVE</th>
                        <th>CANCEL</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>DATE</th>
                        <th>VENDOR</th>
                        <th>STATUS</th>
                        <th>BRAND</th>
                        <th>PRODUCT NAME</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>COST</th>
                        <th>RECEIVE</th>
                        <th>CANCEL</th>


                    </tr>
                    </tfoot>

                    <tbody>

                    @if($purchases)
                        @foreach($purchases as $purchase)

                            @php
                            $firstdate = strtotime($purchase->created_at);
                            $date = date('d-M-Y', $firstdate);
                            @endphp

                    <tr>

                        <td>{{ $date }}</td>
                        <td>{{ strtoupper($purchase->vendor) }}</td>
            <td>
                <span class="badge badge-pill @if($purchase->status == 'received') badge-success @else badge-danger @endif" style="font-size: 1em;">
                    {{ $purchase->status }}
                </span>
            </td>
                        <td>{{ $purchase->brand }}</td>
                        <td>{{ $purchase->name }}</td>
                        <td>{{ number_format($purchase->price, 2) }}</td>
                        <td>{{ $purchase->qty }}</td>
                        <td>{{ number_format($purchase->cost, 2) }}</td>
    <td>
        @if($purchase->status == 'open')
            {!! Form::open(['method'=>'POST', 'action'=>['admin\PurchaseController@receive', $purchase->id]]) !!}
        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to receive this order?');"><b>Receive</b></button>
            {!! Form::close() !!}
        @else
        <span style="font-size: 1em;" class=" text-center badge-secondary badge-pill">Closed</span>
        @endif
    </td>
        <td>
            @if($purchase->status == 'received')
                <span style="font-size: 1em;" class=" text-center badge-secondary badge-pill">Closed</span>
            @else
            {!! Form::open(['method'=>'POST', 'action'=>['admin\PurchaseController@cancel', $purchase->id]]) !!}
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this order? There no Undo!!.');">
                <i class="fas fa-times"></i>
            </button>
            {!! Form::close() !!}
            @endif
        </td>

                    </tr>


                    @endforeach
             @endif
                    </tbody>
                </table>
            </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection