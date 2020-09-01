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

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-money-bill fa-lg"></i> <b>Order Receipt</b>
                </li>
            </ol>
            <br>

            <a href="/sales" class="hideme"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>
            <button id="print" onclick="printInvoice();" title="Print Invoice" class="btn btn-success"><i class="fas fa-print fa-lg"></i></button>



  <div  id="printArea">

                {{--  Print styles    --}}
      <style>
          @media print {

              .compDetails{
                  margin-top: 0px;
              }

              table{
                  font-size: 11px!important;
              }
              .developer{
                  text-align: center;
                  font-size: 10px!important;
                  margin-top: 0px;
              }

              .rest{
                  font-size: 11px!important;
              }

              .compName{
                  font-size: 13px!important;
              }

              .totalInvoice{
                  font-size: 12px!important;
              }


          }

          @media screen {
              .totalPrice, .change {
                  font-size: 1.5em;
              }

              .change{
                  font-weight: bold;
              }

          }
      </style>

                        <p style="text-align: center;" class=" rest compDetails">
                        <b class="compName" style="font-size: 2em;">{{$companyName}}</b> <br>
                        Location: {{$companyAddress}}.<br>
                        Tel: {{$companyContact}}.
                        </p>

            <hr>

            @if(!Cart::isEmpty())

           <div class="container-fluid">

               <div class="row justify-content-center">

                   <div class="col-md-8 modify-col">
                       <p class="rest">
                           <b>Receipt No: {{ $invoice }}</b><br>
                           <b>Date: {{ date("d-M-Y") }} {{date("H:i:s")}}</b><br>
                           <b>Cashier: {{ ucwords(strtolower(auth()->user()->name)) }}</b><br>
                       </p>
                   </div>

               </div>

               <div class="row justify-content-center">

                   <div class="col-md-8 modify-col">
                      <div class="table-responsive">




              <table class="table">

                <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Sub.Total</th>
                </tr>
                </thead>

                  <tbody>

                  @foreach(Cart::all() as $product)

                      <tr>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->qty }}</td>
                          <td>{{ number_format($product->price, 2) }}</td>
                          <td>{{ number_format($product->amount, 2) }}</td>
                      </tr>

                  @endforeach

                  </tbody>
                  </table>

              </div>
                  <hr>


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

                       <div class="rest">
                           <span class="totalPrice"><b>TOTAL: <span class="text-danger">GH₵ {{ $total_orders }}</span></b></span> <br>
                           <span>DISCOUNT: GH₵ {{ $discount }}</span> <br>
                           <span>CASH TENDERED: GH₵ {{ number_format($tendered , 2)}}</span> <br>
                           <span class="change">CHANGE: GH₵ {{ number_format(($tendered - $total), 2) }}</span> <br>
                       </div>
                       <br>

                       <div class="text-center developer">
                           Software By<b> Appiah</b> <br>
                           Tel: 0242740320
                       </div>

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
                        {{--Print Invioce--}}
                    function printInvoice(){

                        var divtoprint = document.getElementById("printArea");
                        var newWindow = window.open('','Print-Window', 'height=600, width=600');

                        newWindow.document.open();
                        newWindow.document.write("<html><body onload='window.print()'>"+divtoprint.innerHTML+"</body></html>");

                        newWindow.document.close();

                        setTimeout(function () {
                            newWindow.close();
                        },2000)

                    }

                </script>
    @endsection
