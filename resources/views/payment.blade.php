@php
    use Overtrue\LaravelShoppingCart\Facade as Cart;
    use App\Company;
    $cmp = Company::first()->get();
@endphp

@foreach($cmp as $cmpp)
    @php
        $companyName = $cmpp->name;
        $companyAddress = $cmpp->address;
        $companyContact = $cmpp->contact;
      break;

    @endphp
@endforeach



@extends('layouts.layout')



@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-money-bill fa-lg"></i> <b>Order Receipt</b>
                </li>
            </ol>
            <br>

            <a href="/sales" class="hideme"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>
            <button id="print" title="Print Invoice" class="btn btn-success"><i class="fas fa-print fa-lg"></i></button>


                        <p style="text-align: center;">
                        <b style="font-size: 2em;">{{$companyName}}</b> <br>
                        Location: {{$companyAddress}}.<br>
                        Tel: {{$companyContact}}.
                        </p>

            <hr>

            @if(!Cart::isEmpty())

           <div class="container-fluid">

               <div class="row justify-content-center">

                   <div class="col-md-8 modify-col">
                       <p>
                           <b>Invoice#: {{ $invoice }}</b><br>
                           <b>Date: {{ date("d-M-Y") }}</b><br>
                           <b>Customer: {{ ucwords(strtolower($customer)) }}</b><br>
                       </p>
                   </div>

               </div>

               <div class="row justify-content-center">

                   <div class="col-md-8 modify-col">
                      <div class="table-responsive">


                              @foreach(Cart::all() as $product)

                                  <table class="table">

                                      <style>
                                          .right{
                                              text-align: right;
                                          }
                                      </style>

                                      <tr>
                                          <td >Item</td>
                                          <td class="right"><b>{{ $product->name }}</b></td>
                                      </tr>

                                      <tr>
                                          <td>Qty</td>
                                          <td class="right">{{ $product->qty }}</td>
                                      </tr>

                                      <tr>
                                          <td>Price</td>
                                          <td class="right">{{ number_format($product->price, 2) }}</td>
                                      </tr>

                                      <tr>
                                          <td>Discount</td>
                                          <td class="right">{{ number_format($product->discount, 2) }}</td>
                                      </tr>

                                      <tr>
                                          <td>Total</td>
                                          <td class="text-danger right">{{ number_format($product->amount, 2) }}</td>
                                      </tr>

                                  </table>
                                  <hr style="border: 1px solid black;">
                              @endforeach


                      </div>
                       <br>

                       {{--    Calculate Total Orders   --}}
                       @php
                           $calc_total = array();

                           foreach (Cart::all() as $cal){
                               array_push($calc_total, $cal->amount);
                           }
                           $total = array_sum($calc_total);
                           $total_orders = number_format($total, 2);

                       @endphp

                       {{--    Calculate Total Discount   --}}
                       @php
                           $calc_discount = array();

                           foreach (Cart::all() as $calculate){
                               array_push($calc_discount, $calculate->discount);
                           }
                           $discount = array_sum($calc_discount);
                           $discount = number_format($discount, 2);

                       @endphp

                       <div style="font-size: 1.2em;">
                           <span><b>TOTAL: <span class="text-danger" style="font-size: 1.3em;">GH₵ {{ $total_orders }}</span></b></span> <br>
                           <span><b>DISCOUNT: GH₵ {{ $discount }}</b></span> <br>
                           <span><b>CASH TENDERED: GH₵ {{ number_format($tendered , 2)}}</b></span> <br>
                           <span><b>CHANGE: GH₵ {{ number_format(($tendered - $total), 2) }}</b></span> <br>
                       </div>
                       <br>

                       <div class="text-center">
                           Software By<b> Appiah</b> <br>
                           Tel: 0242740320
                       </div>

                   </div>
               </div>

           </div>

            @endif

    @php
    //Clear Cart
      Cart::destroy();
    @endphp

            @endsection

@section('scripts')

    <script>
                $("#print").click(function () {
                $(".sidebar").hide();
                $("#print").hide();
                $(".breadcrumb").hide();
                $(".hideme").hide();
                $("form").hide();
                $(".sticky-footer").hide();
                $('.modify-col').removeClass('col-md-8').addClass('col-md-12');
                window.print();

                    $(".sidebar").show();
                    $("#print").show();
                    $(".breadcrumb").show();
                    $(".hideme").show();
                    $("form").show();
                    $(".sticky-footer").show();
                    $('.modify-col').removeClass('col-md-12').addClass('col-md-8');
                })
    </script>
@endsection
