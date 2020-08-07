@extends('layouts.layout')

@section('links')
  <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endsection

@section('content')



    <style type="text/css">
        .mk_sale{
            font-family: "Times New Roman", "Marlett", Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
    </style>

    <!-- Form row -->


                    @if(empty($orders))

                        <div id="content-wrapper">
                            <div class="container-fluid">



                                <h1 class="text-center mk_sale">Sales Returns</h1><br>
                                <div class="container-fluid">
                                    <div class="row">
                                    {!! Form::open(['method'=>'POST', 'action'=>'ReturnsController@search']) !!}<!-- Form start here -->

                            <label><b>Enter Invoice Number</b></label>
                            <div class="input-group">
                                <input type="search" class="form-control" name="invoice" placeholder="Invoice Number" autocomplete="off">
                                <button type="submit" class="btn btn-primary" name="search"><i class="fas fa-search"></i> Search</button>
                            </div>

                        {!! Form::close() !!}    <!-- Form ends here -->

                </div>
                <br>

                 @if(Session::has('fail_return'))
                    <h3 class="text-danger">
                        <b>{{ session('fail_return') }}</b>
                    </h3>
                @endif



                {{-- if there is change --}}
                @if(Session::has('change'))
                  @if (session('change') > 0)
                      <h2 class="text-center text-danger"><b>Change : GH₵ {{ number_format(session('change'), 2) }}</b></h2>
                  @endif
                @endif


            @else




<div id="content-wrapper">
    <div class="container-fluid">

        <br>
        <a href="{{ route('returns') }}"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>
        <h1 class="text-center mk_sale">Sales Returns</h1><br>


    <div class="container-fluid">
        <div class="row">  <!-- Form row -->




    {!! Form::open(['method'=>'POST', 'action'=>'ReturnsController@return']) !!} <!-- Form start here -->

        <div class="input-group">
            <select name="select" class="custom-select" required>
                <option value="">Select option</option>
                <option value="return">Return</option>
            </select>
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Apply</button>
        </div>


        </div>
        <br>

        <br> <br><!-- End of form row -->



                                                    <!-- Table  -->
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-striped  table-hover table-dark">
                  <thead>
                    <tr>
                        <th><input type="checkbox" id="selectall"></th>
                        <th>INVOICE NUMBER</th>
                        <th>CATEGORY</th>
                        <th>BRAND</th>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>DISCOUNT</th>
                        <th>TOTAL</th>
                        <th>ORDER DATE</th>
                    </tr>
                </thead>


                    <tbody>
                    @foreach($orders as $order)

                    <tr>
                        <td><input type="checkbox" class="checkboxes" name="checkboxarray[]" value="{{ $order->id }}"></td>
                        <td>{{ $order->invoice }}</td>
                        <td>{{ $order->category }}</td>
                        <td>{{ $order->brand }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ number_format($order->selling_price, 2) }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ number_format($order->discount, 2) }}</td>
                        <td>{{ number_format($order->amount, 2) }}</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>

                    @endforeach
                    </tbody>



                </table>
              {!! Form::close() !!}   <!-- Form ends here -->

            </div> <!-- ./table-responsive -->
        </div>
    </div>
</div>
</div>


      @endif


@endsection



 @section('scripts')

    <script src="{{ asset('js/toastr.js') }}"></script>

    <script>

        $(function () {

            $("#selectall").click(function () {
                $(".checkboxes").prop("checked", this.checked);
            });

        });


    </script>
 @endsection