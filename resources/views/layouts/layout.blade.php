
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INNOCENT</title>
    <link rel="icon"  href="{{ asset('img/logo.ico') }}">


    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">


@yield('links')

</head>

<style>
    .sticky-footer{
        background: #ccc !important;
    }




    #preloader:before {
        content: "";
        position: fixed;
        top: calc(50% - 30px);
        left: calc(50% - 30px);
        border: 6px solid #f2f2f2;
        border-top: 6px solid #4e7dff;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        -webkit-animation: animate-preloader 1s linear infinite;
        animation: animate-preloader 1s linear infinite;
    }

    @-webkit-keyframes animate-preloader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes animate-preloader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

</style>

<body id="page-top" style="background: #ccc;">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/"><b>POINT OF SALE</b></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Display Session Username -->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="text-white-50">
            <span><marquee> <b style='font-size: 1.2em;'>Welcome! {{ Auth::user()->name }}</b></marquee></span>

        </div>
    </div>   &nbsp; &nbsp; &nbsp; &nbsp;

    <!-- logout -->
    <div class="navbar-nav ml-auto ml-md-0">

        <a href="" id="logout" style="text-decoration: none;" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); this.style.display = 'none';">
            <i class="fas fa-power-off fa-lg text-danger"></i>
            <span style="font-size: 1.2em; font-weight: bold;" class="text-white">Logout</span>
        </a>
        &nbsp; &nbsp;
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

</nav>


<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

        <br>
        <li class="nav-item">
            <a class="nav-link" href="/sales">
                <i class="fas fa-fw fa-money-bill-wave fa-lg" style="color: violet"></i>
                <span class="text-white">&nbsp; Make A Sale</span></a>
        </li>


     @if(Auth::user()->isAdmin())

        <li class="nav-item permission">
            <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-star fa-lg text-primary"></i>
                <span class="text-white">&nbsp; Products</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('vendors.index') }}">
                <i class="fas fa-fw fa-home fa-lg text-success"></i>
                <span class="text-white">&nbsp; Vendors</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="fas fa-fw fa-sitemap fa-lg text-light"></i>
                <span class="text-white">&nbsp; Category</span></a>
        </li>


        <!--   Purchase Dropdown-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/admin/purchase" id="purchases" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-shopping-cart fa-lg text-danger"></i>
                <span class="text-white">&nbsp; Purchases</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="purchases">

                <a class="dropdown-item change_color" href="/admin/purchase">Make Purchase</a>
                <a class="dropdown-item change_color" href="{{ route('purchase.order.list') }}">Purchase Order List</a>

            </div>
        </li>       <!--   ./Purchase Dropdown-->

    @endif


        <!--  Styling dropdown Items      -->
        <style>
            .change_color:hover{
                background: #2f2f2f;
                color: wheat;
            }
        </style>



        <!-- Reports-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reports" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-receipt fa-lg text-info"></i>
                <span class="text-white">&nbsp; Reports</span>
            </a>
            <div class="dropdown-menu text-white-50" aria-labelledby="reports">
                <h6 class="dropdown-header text-success">Sales</h6>
                <a class="dropdown-item change_color mytooltip" href="{{ route('daily_sale') }}">Today's Sales</a>
                <a class="dropdown-item change_color mytooltip" href="{{ route('sales_report_by_date') }}">Sales Report By Date</a>

                @if(Auth::user()->isAdmin())

                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header text-danger">Products</h6>
                <a class="dropdown-item change_color mytooltip" href="{{ route('products_lists') }}" title="View detailed report of your current inventory">Products List</a>
                <!--        <a class="dropdown-item change_color" href="">Inventory Valuation</a>-->
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header text-primary">Purchases</h6>
                <a class="dropdown-item change_color mytooltip" href="{{ route('purchases_report_by_date') }}" title="Search purchase orders by date">Purchases By Date</a>
                <a class="dropdown-item change_color mytooltip" href="{{ route('open_purchases') }}" title="Show all outstanding purchase orders">Open Purchase Orders</a>

                @endif
            </div>
        </li>     <!-- ./Reports-->


        <!-- Sales Returns -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('returns') }}">
                <i class="fas fa-fw fa-receipt fa-lg text-warning"></i>
                <span class="text-white">&nbsp; Sales Returns</span></a>
        </li>



        @if(Auth::user()->isAdmin())
        <!--   Settings Dropdown-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="purchases" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-cog fa-lg"></i>
                <span class="text-white">&nbsp; Settings</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="purchases">

                <a class="dropdown-item change_color" href="{{ route('users.index') }}">Manage Users</a>
                <a class="dropdown-item change_color" href="{{ route('passwords') }}">Reset Password</a>

            </div>
        </li>       <!-- ./Settings Dropdown-->

        @else


            <li class="nav-item">
                <a class="nav-link" href="{{ route('passwords') }}">
                    <i class="fas fa-fw fa-lock fa-lg"></i>
                    <span class="text-white"> Reset Password</span></a>
            </li>

        @endif

        <br> <br>

        <!-- Backup -->
{{--        <li class="nav-item">            --}}
{{--            <a class="nav-link" href="" style="color: #ffabb7;">--}}
{{--                <i class="fas fa-fw fa-database fa-lg"></i>--}}
{{--                <span> Back Up</span></a>--}}
{{--        </li>--}}

    </ul>


    @yield('content')


    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto" style="font-size: 1em;">
                <strong>Copyright &copy; @php echo date('Y'); @endphp <span class="text-primary">Innocent Enterprise</span>.</strong>
                All rights reserved.
            </div>
        </div>
    </footer>

</div>
<!-- /#wrapper -->


<div id="preloader"></div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>

<script src="{{ asset('css/fontawesome-free/js/all.min.js') }}"></script>

@yield('scripts')


<script>

    window.onload = function(){

        if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function () {
                $(this).remove();
            });
        }



            const prev = document.querySelector('.prev');
            const myForm = document.querySelector('.myForm');

            myForm.onsubmit = function () {
                prev.style.display = 'none';
            };

        @if(Session::has('success'))
        toastr.info('{{session('success')}}');
        @endif

        @if(Session::has('warning'))
        toastr.error('{{ session('warning') }}');
        @endif

        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.warning('{{ $error }}');
        @endforeach
        @endif


    }

</script>

</body>
</html>


