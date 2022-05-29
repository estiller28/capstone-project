@extends('layouts.admin')

@section('title', 'Citizen')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Citizen Profile
                        <span> <i class="ml-2 fas fa-users"></i></span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('citizen/all') }}">Citizens</a></li>
                        <li class="breadcrumb-item active">Citizen Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-circle" style="width: 120px; height: 120px;"  src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="">
                            </div>
                            <h3 class="profile-username text-center">{{$citizen->first_name. ' '. $citizen->last_name}}</h3>

                            <p class="text-muted text-center">Bsit</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    @if($citizen->email != null)
                                        <b>Email:</b> <p class="float-right">{{$citizen->email}}</p>
                                    @else
                                        <b>Email:</b> <p class="float-right">--</p>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile:</b> <p class="float-right">09978839185</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <p class="float-right">Union Gubat Sorsogon</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-4">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">General</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Account Access</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Records</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <div class="row justify-content-between">
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <div class="card-label mb-4">
                                                                Primary Information
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-group mb-3">
                                                        <li class="list-group-item">
                                                            <b>First Name:</b> <p class="float-right">{{$citizen->first_name}}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Middle Name:</b> <p class="float-right">{{$citizen->middle_name}}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Last Name:</b> <p class="float-right">{{$citizen->last_name}}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            @if($citizen->email != null)
                                                                <b>Email:</b> <p class="float-right">{{$citizen->email}}</p>
                                                            @else
                                                                <b>Email:</b> <p class="float-right">---</p>
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Address</b> <p class="float-right"><input class="editData" id="edit" disabled type="text" value="Union Gubat Sorsogon"></p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Mobile Number:</b> <p class="float-right">09978839185</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Date of Birth:</b> <p class="float-right">August 1, 2000</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <button class="btn btn-primary" id="btnEdit">Edit</button>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <div class="card-label mb-4">
                                                                Personal Information
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-group mb-3">
                                                        <li class="list-group-item">
                                                            <b>Name:</b> <p class="float-right">{{Auth::user()->name}}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Email:</b> <p class="float-right">{{Auth::user()->email}}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Address</b> <p class="float-right">Union Gubat Sorsogon</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Mobile Number:</b> <p class="float-right">09978839185</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Date of Birth:</b> <p class="float-right">August 1, 2000</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <form class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row justify-content-between">
                                            @if($citizen->user_id != null)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    Login Credentials
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group add-error mb-4">
                                                                <label>Role:</label>
                                                                <select style="width: 100%;" name="roles" class="form-control role custom-select" id="roles"  required aria-describedby="validationServer03Feedback">
                                                                    <option value="1">Admin</option>
                                                                    <option value="2">Citizen</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" value="{{ $citizen->email }}">
                                                            <div class="form-group add-error mb-4">
                                                                <label>Password:</label>
                                                                <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                <span class="text-danger error-text purok_name_error"></span>
                                                            </div>
                                                            <div class="form-group add-error mb-4">
                                                                <label>Confirm Password:</label>
                                                                <input type="password" name="passwordConfirm" class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                <span class="text-danger error-text purok_name_error"></span>
                                                            </div>
                                                            <div class="form-group mb-4 adminBtn">
                                                                <button class="btn btn-sm btn-primary">Save User Access</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="adminDiv">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    User Access Permissions
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @foreach($permissions as $permission)
                                                                <div class="form-check icheck-primary">
                                                                    <input name="permission" class="form-check-input" type="checkbox" value="" id="{{ $permission->id }}"
                                                                         @if($user->hasPermissionTo($permission->id))   checked @endif />
                                                                    <label class="form-check-label" for="{{ $permission->id }}"> {{ $permission->name }}</label>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-group mt-5 text-right">
                                                                <button type="submit" class="btn btn-sm btn-primary">Save User Access</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    Login Credentials
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group add-error mb-4">
                                                                <label>Role:</label>
                                                                <select style="width: 100%;" name="roles" class="form-control no-role custom-select" id="roles"  required aria-describedby="validationServer03Feedback">
                                                                    <option value="" selected="selected">Select User Type</option>
                                                                    <option value="1">Admin</option>
                                                                    <option value="2">Citizen</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" value="{{ $citizen->email }}">
                                                            <div class="form-group add-error mb-4">
                                                                <label>Password:</label>
                                                                <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                <span class="text-danger error-text purok_name_error"></span>
                                                            </div>
                                                            <div class="form-group add-error mb-4">
                                                                <label>Confirm Password:</label>
                                                                <input type="password" name="passwordConfirm" class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                <span class="text-danger error-text purok_name_error"></span>
                                                            </div>
                                                            <div class="form-group mb-4 userBtn">
                                                                <button class="btn btn-sm btn-primary">Save User Access</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="permissionDiv">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    User Access Permissions
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @foreach($permissions as $permission)
                                                                <div class="form-check icheck-primary">
                                                                    <input class="form-check-input" type="checkbox" value="" id="{{ $permission->id }}" />
                                                                    <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-group mt-5 text-right">
                                                                <button type="submit" class="btn btn-sm btn-primary">Save User Access</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="settings">
                                    <ul class="list-group mb-3">
                                        <p class="text-center">No data available</p>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-md-5">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-header"><strong>Update Citizen Information</strong> </div>--}}
            {{--                    <div class="card-body">--}}
            {{--                        <form action="{{ url('citizen/update/'. $citizens->id) }}" method="post">--}}
            {{--                            @csrf--}}
            {{--                            <div class="mb-3">--}}
            {{--                                <label for="citizen" class="form-label">First Name</label>--}}
            {{--                                <input type="text" class="form-control" id="citizen" name="first_name" value="{{ $citizens->first_name}}">--}}

            {{--                                @error('first_name')--}}
            {{--                                <span class="text-danger"> {{ $message }}</span>--}}
            {{--                                @enderror--}}

            {{--                                <label for="citizen" class="form-label">Middle Name</label>--}}
            {{--                                <input type="text" class="form-control" id="category" name="middle_name" value="{{ $citizens->middle_name}}">--}}

            {{--                                @error('middle_name')--}}
            {{--                                <span class="text-danger"> {{ $message }}</span>--}}
            {{--                                @enderror--}}

            {{--                                <label for="citizen" class="form-label">Last Name</label>--}}
            {{--                                <input type="text" class="form-control" id="category" name="last_name" value="{{ $citizens->last_name}}">--}}

            {{--                                @error('last_name')--}}
            {{--                                <span class="text-danger"> {{ $message }}</span>--}}
            {{--                                @enderror <br>--}}

            {{--                                <label for="citizen" class="form-label">Purok</label>--}}
            {{--                                <select class="form-select" name="purok">--}}
            {{--                                    @if($puroks->isEmpty())--}}
            {{--                                        <option disabled> No Data </option>--}}
            {{--                                    @endif--}}
            {{--                                    @foreach($puroks as $purok)--}}
            {{--                                        <option value="{{$purok->id}}" {{$citizens->purok_id == $purok->id ? 'selected' : ''  }}>{{$purok->purok_name}}</option>--}}
            {{--                                    @endforeach--}}
            {{--                                </select>--}}
            {{--                            </div>--}}
            {{--                            <button type="submit" class="btn btn-primary">Update Citizen</button>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </section>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <style>
        .post{
            color: black !important;
        }
        #permissionDiv{
            display: none;
        }

        .editData{
            width: 100% !important;
            line-height: 0 !important;
            text-indent: 29px !important;
            border: none;
            background: none !important;
        }

        .form-control:disabled{

            width: 20% !important;

        }

    </style>
    <script>
        $(function(){
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });


        $(document).ready(function (){
            $('.adminBtn').hide();

            $('.role').on('change', function (){
                if(this.value == '1'){
                    $('#adminDiv').show();
                    $('.adminBtn').hide();
                }
                else{
                    $('.adminBtn').show();
                    $('#adminDiv').hide();
                }
            });

            $('.no-role').on('change', function (){
                if(this.value == '1'){
                    $('#permissionDiv').show();
                    $('.userBtn').hide();
                }
                else{
                    $('.userBtn').show();
                    $('#permissionDiv').hide();
                }
            });

            $('#btnEdit').on('click', function (){
                $('.editData').removeAttr('disabled');
                $("input").removeClass('.editData');
                $("input").addClass('.form-control');

            })
        });

    </script>
@endsection
