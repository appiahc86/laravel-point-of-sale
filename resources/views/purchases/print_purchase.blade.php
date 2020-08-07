@extends('layouts.layout')

@section('content')

    @php use Overtrue\LaravelShoppingCart\Facade as PurchaseCart; @endphp

    <div id="content-wrapper" style="background: #ccc;">
        <div class="container">

            <br>


            {{--   Display Vendor information--}}

            <h2 class="text-center font-weight-bold">{{ strtoupper(strtolower($vendor->company)) }}</h2>
            <h6 class="text-center">{{ $vendor->company_address }}</h6>
            <h6 class="text-center">{{ $vendor->phone }}</h6>
            <br>
            <a href="/"><button class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</button></a>


            <br>
            <br>


            <div class="table-responsive">
                @if(!PurchaseCart::isEmpty())

                <table class="table">
                    <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>qty</th>
                        <th>Cost</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach(PurchaseCart::all() as $purchase)
                    <tr>

                        <td>{{ $purchase->product->brand }}</td>
                        <td>{{ $purchase->name }}</td>
                        <td>{{ number_format($purchase->price, 2)}}</td>
                        <td>{{ $purchase->qty }}</td>
                        <td>{{ number_format($purchase->total, 2) }}</td>

                    </tr>

                    @endforeach

                    <tr>
                        <td colspan="4" style="text-align: right">

                            <b>Total: </b></td>

                        <td><b>GH₵ {{ number_format(PurchaseCart::total(), 2) }}
                            </b>
                        </td>
                    </tr>


                    </tbody>
                </table>

                    @php
                        //Clear Cart
                          PurchaseCart::destroy();
                    @endphp

                    <br>
                    <button class="btn btn-primary" id="print"><i class="fas fa-print"></i> Print</button>
               @endif

            </div>


@endsection


@section('scripts')
    <script>
         $(function () {
                    $("#print").click(function () {
                        $(".sidebar").hide();
                        $("a").hide();
                        $(".breadcrumb").hide();
                        $(".hideme").hide();
                        $("form").hide();
                        $(".sticky-footer").hide();
                        $(this).hide();
                        window.print();
                       
                        $(".sidebar").show();
                        $("a").show();
                        $(".breadcrumb").show();
                        $(".hideme").show();
                        $("form").show();
                        $(".sticky-footer").show();
                        $(this).show();
                    });

                });
</script>
@endsection

