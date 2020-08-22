@extends('layouts.layout')

@section('links')
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endsection

@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item" style="font-size: 1.4em;">
                    <i class="fas fa-fw fa-user-friends fa-lg"></i> <b>USERS</b>
                   @if(Session::has('success'))
                        <span class="text-success ml-5">{{session('success')}}</span>
                   @endif
                </li>
            </ol>
            <br><br>

            <a href="{{ route('home') }}"><button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Back</button></a>
            <a href="{{ route('register') }}" ><button class="btn btn-success">Add User</button></a>


            <br><br>

            <!-- DataTables -->

            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>NAME</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>NAME</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                        <th colspan="2"></th>
                    </tr>
                    </tfoot>

                    <tbody>

                    @foreach($users as $user)

                  @if (Auth::user()->id == $user->id)
                      @php continue; @endphp
                  @endif

                        <tr>

                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->role == 1 ? 'Admin' : 'Cashier' }}</td>

                            <td>
                                <a href="#del{{$user->id}}" data-toggle="modal" title="Delete This User">
                                    <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                                </a>
                            </td>


                            <td>
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button class="btn btn-primary"><i class="fas fa-lock"></i> <b>Reset</b></button>
                                </a>
                            </td>





                            <!--  Modal for deleting a user-->
                            <div class="modal fade" id="del{{$user->id}}" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
                                <br><br><br><br><br><br><br>
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center text-danger" id="exampleModalLabel"><i class="fas fa-trash-alt"></i><span class="text-danger"> Delete This User</span></h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            <p class="text-dark">Are you sure you want to delete <b>{{$user->name}}</b></p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open(['method'=>'DELETE', 'action'=>['admin\UsersController@destroy', $user->id]]) !!}
                                            {!! Form::submit('Delete', ['class'=>'btn btn-danger prev', 'onclick'=>"this.style.display = 'none'"]) !!}
                                            {!! Form::close() !!}
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>












@endsection


@section('scripts')
<script src="{{ asset('js/toastr.js') }}"></script>
@endsection
