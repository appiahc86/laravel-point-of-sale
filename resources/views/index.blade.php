@extends('layouts.layout')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endsection
@section('content')


<style type="text/css">
    .cmp{
        font-family: "Times New Roman", "Marlett", Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 3em;
        text-shadow: 4px 3px 2px #ccc;
    }


    .sticky-footer{
        background: white !important;
    }


</style>

<div id="content-wrapper" style="background: white !important;">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        {{--  <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a style="text-decoration: none; font-size: 2em;"><i class="fas fa-fw fa-tachometer-alt fa-lg"></i> <b>Dashboard</b></a>
            </li>
        </ol>  --}}

        <div class="text-center" style="font-weight: bold; font-size: 2em;">
            <i class="fas fa-money-bill">
            </i> Sales For Today  <span class="text-danger">GH₵ {{ number_format($sales, 2) }}</span>
        </div>
        <br>


            <div class="row">
                @if(Auth::user()->isAdmin())
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100 permission">
                        <a class="text-white disabled" href="{{ route('products.index') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-anchor"></i>
                                </div>
                               @php
                               $product_count = \App\Product::all()->count();
                               @endphp
                                <div class="mr-5">Products <span style="font-size: 1em;" class="badge badge-danger">{{ $product_count }}</span></div>

                            </div>
                        </a>
                        <a class="card-footer text-white clearfix z-1" href="{{ route('products.index') }}">
                            <span class="float-left">Search Or Manage Products</span>

                        </a>
                    </div>
                </div>

                @else

                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-dark o-hidden h-100 permission">
                            <a class="text-white disabled" href="{{ route('passwords') }}" style="text-decoration: none">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-fw fa-lock-open"></i>
                                    </div>

                                    <div class="mr-5">Reset Password </div>

                                </div>
                            </a>
                            <a class="card-footer text-white clearfix z-1" href="{{ route('passwords') }}">
                                <span class="float-left">Reset Current Password</span>

                            </a>
                        </div>
                    </div>

                @endif

                <div class="col-xl-3 col-sm-6 mb-3 "> <!-- Make a sale -->
                    <div class="card text-white bg-success o-hidden h-100 ">
                        <a class="text-white" href="/sales" style="text-decoration: none">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-shopping-cart"></i>
                                </div>
                                <div class="mr-5">Sales</div>

                            </div> </a>
                        <a class="card-footer text-white clearfix z-1" href="/sales">
                            <span class="float-left">Make A Sale</span>
                        </a>

                    </div>
                </div>


                <div class="col-xl-3 col-sm-6 mb-3">   <!-- Sales report -->
                    <div class="card text-white bg-warning o-hidden h-100">
                        <a class="text-white" href="{{ route('daily_sale') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-list-alt"></i>
                                </div>
                                <div class="mr-5">Sales Report</div>
                            </div>
                        </a>
                        <a class="card-footer text-white clearfix  z-1" href="{{ route('daily_sale') }}">
                            <span class="float-left">Daily Sales Report</span>
                        </a>
                    </div>
                </div>

              @if(Auth::user()->isAdmin())

                <div class="col-xl-3 col-sm-6 mb-3">  <!-- Purchases -->
                    <div class="card text-white bg-danger o-hidden h-100 permission">
                        <a class="text-white" href="admin/purchase" style="text-decoration: none">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-shopping-cart"></i>
                                </div>
                                <div class="mr-5">Purchases</div>
                            </div>
                        </a>
                        <a class="card-footer text-white clearfix z-1" href="admin/purchase">
                            <span class="float-left">Make Purchases</span>
                        </a>
                    </div>
                </div>

                    @else

                        <div class="col-xl-3 col-sm-6 mb-3">  <!-- Purchases -->
                            <div class="card text-white bg-danger o-hidden h-100 permission">
                                <a class="text-white" href="{{ route('returns') }}" style="text-decoration: none">
                                    <div class="card-body">
                                        <div class="card-body-icon">
                                            <i class="fas fa-fw fa-shopping-cart"></i>
                                        </div>
                                        <div class="mr-5">Returns</div>
                                    </div>
                                </a>
                                <a class="card-footer text-white clearfix z-1" href="{{ route('returns') }}">
                                    <span class="float-left">Sales Returns</span>
                                </a>
                            </div>
                        </div>

                @endif
            </div>


            <!-- Charts -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i>
                           <b> Sales Bar Chart</b></div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="50"></canvas>
                        </div>
                        <div class="card-footer small text-muted"><b>Updated </b>

                            {{ \Carbon\Carbon::now()->diffForHumans() }}
                        </div>
                    </div>

                </div>

                            {{--     Pie Chart     --}}
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i>
                            <b> Sales Pie Chart</b></div>
                        <div class="card-body">
                            <canvas id="myPieChart" width="100%" height="100"></canvas>
                        </div>
                        <div class="card-footer small text-muted">
                            <b>Updated</b>
                                {{ \Carbon\Carbon::now()->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>   <!-- Charts -->



        </div>
        <!-- /.container-fluid -->




@endsection

{{-- Include Bar and Pie Chart--}}
@section('scripts')


         <script src="{{ asset('js/Chart.min.js') }}"></script>
        @include('partials.barchart')
        @include('partials.piechart')
        <script src="{{ asset('js/toastr.js') }}"></script>
@endsection
