@extends('layouts.layout')

@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">

            <li class="breadcrumb-item" style="font-size: 1.4em;">
                <i class="fas fa-fw fa-money-bill-alt fa-lg"></i> <b>MAKE PURCHASE</b>
            </li>
        </ol>
        <br><br>


        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover table-striped " id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 70%;">VENDOR</th>
                    <th>ORDER</th>
                </tr>
                </thead>

                <tbody>

  @if($vendors)
      @foreach($vendors as $vendor)

    <tr>
        <td>{{ strtoupper(strtolower($vendor->company)) }}</td>
        <td>
            <a href="{{ route('admin.purchase.show', $vendor->id) }}">
                <button class="btn btn-primary"><i class="fas fa-shopping-cart"></i></button></a>
        </td>
    </tr>

    @endforeach
     @endif

                </tbody>

            </table>

        </div>













        <!--   Modal for Adding new Vendor-->
        <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <br>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-plus"></i><span class="text-info"> Add New Category</span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="#">
                            <label>Category Name</label>
                            <input name="cat_name" type="text" class="form-control" placeholder="Category Name" autocomplete="off" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="save_vendor" class="btn btn-primary">Save</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>

                    </form>


                </div>
            </div>
        </div>


@endsection
