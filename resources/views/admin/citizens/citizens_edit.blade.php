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
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
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
                            <div class="text-center" id="change_profile">
                                <input type="hidden" name="citizen_id" id="citizen_id" value="{{ $citizen->id }}">
                                @if(!$user == null)
                                    <img class="profile-user-img img-circle" style="width: 120px; height: 120px;"  src="{{ $user->picture  }}" alt="">
                                @else
                                    <img id="change_profile" class="profile-user-img img-circle" style="width: 120px; height: 120px;"  src="{{ asset('user/avatar.png') }}" alt="">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$citizen->first_name. ' '. $citizen->last_name}}</h3>
                            <input type="file" id="profile_img" class="form-control" name="profile_image" style="display: none;">

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
                                                            <div class="card-label">
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
                                                            <b>Address</b> <p class="float-right"><input class="editData edit" id="edit" disabled type="text" value="Union Gubat Sorsogon"></p>
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

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <div class="card-label">
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
                                            <div class="col-md-6">
                                                <button id="btnEdit" class="btn btn-dark">Edit Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <div class="row justify-content-between">
                                        @if($citizen->user_id != null && $user != null)
                                            @if($user->hasRole('Admin'))
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
                                                            <form action="">
                                                                <div class="form-group mb-4">
                                                                    <label>Role:</label>
                                                                    <select style="width: 100%;" name="roles" class="form-control role custom-select" id="roles"  required aria-describedby="validationServer03Feedback">
                                                                        <option value="">Select User Type</option>
                                                                        <option selected="selected" value="1">Admin</option>
                                                                        <option  value="2">Citizen</option>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" value="{{ $citizen->email }}">
                                                                {{--                                                            <div class="form-group mb-4">--}}
                                                                {{--                                                                <label>Password:</label>--}}
                                                                {{--                                                                <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="on">--}}
                                                                {{--                                                                <span class="text-danger error-text purok_name_error"></span>--}}
                                                                {{--                                                            </div>--}}
                                                                {{--                                                            <div class="form-group mb-4">--}}
                                                                {{--                                                                <label>Confirm Password:</label>--}}
                                                                {{--                                                                <input type="password" name="passwordConfirm" class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="on">--}}
                                                                {{--                                                                <span class="text-danger error-text purok_name_error"></span>--}}
                                                                {{--                                                            </div>--}}
                                                                <div class="form-group mb-4 adminBtn">
                                                                    <button class="btn btn-sm btn-primary">Save User Access</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="adminDiv">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    User Access Permissions sss
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="needs-validation" novalidate  action="{{ url('citizen/edit/permission/' . $citizen->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body">
                                                                @foreach($permissions as $permission)
                                                                    <div class="form-check icheck-primary">
                                                                        <input name="permission[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" id="{{ $permission->id }}"
                                                                               @if($user->hasPermissionTo($permission->id))   checked @endif  />
                                                                        <label class="form-check-label" for="{{ $permission->id }}"> {{ $permission->name }}</label>
                                                                    </div>
                                                                @endforeach
                                                                <div class="form-group mt-5 text-right">
                                                                    <button class="btn btn-sm btn-info">
                                                                        <span> <i class="mr-2 fa-solid fa-square-pen"></i></span>Save User Access</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                {{--                                                Citizen access--}}
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
                                                            <form class="needs-validation" novalidate action="{{ url( 'citizen/edit/access/' .$citizen->id) }}" method="post">
                                                                @csrf
                                                                <div class="form-group mb-4">
                                                                    <label>Role:</label>
                                                                    <select style="width: 100%;" name="roles" class="form-control role custom-select" id="citizenRole"  required aria-describedby="validationServer03Feedback">
                                                                        <option  value="">Select User Type</option>
                                                                        <option  value="1">Admin</option>
                                                                        <option selected  value="2">Citizen</option>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" value="{{ $citizen->email }}">
                                                                <div class="form-group mb-4">
                                                                    <label>Password:</label>
                                                                    <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <label>Confirm Password:</label>
                                                                    <input type="password" name="password_confirmation" class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                                                                    <span class="text-danger error-text purok_name_error"></span>
                                                                </div>
                                                                <div class="form-group mb-4 userBtn">
                                                                    <button class="btn btn-sm btn-info">
                                                                        <span> <i class="mr-2 fa-solid fa-square-pen"></i></span>Update User Access</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="citizenPermission">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="card-label">
                                                                    User Access Permissions
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="" method="">
                                                                @foreach($permissions as $permission)
                                                                    <div class="form-check icheck-primary">
                                                                        <input name="permission[]" class="form-check-input" type="checkbox" value="" id="{{ $permission->id }}" />
                                                                        <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                                    </div>
                                                                @endforeach
                                                                <div class="form-group mt-5 text-right">
                                                                    <button class="btn btn-sm btn-info">
                                                                        <span> <i class="mr-2 fa-solid fa-square-pen"></i></span>Save User Access</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        @else
                                            {{--                                            NO user_id--}}
                                            <div class="col-12">
                                                <form class="needs-validation"  novalidate id="NoUserId" action="{{ url('citizen/add/user/'. $citizen->id) }}" method="post">
                                                    @csrf
                                                    <div class="row justify-content-between">
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <div class="card-label">
                                                                            Login Credentials No Use
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group mb-4">
                                                                        <label>Role:</label>
                                                                        <select style="width: 100%;" name="role" class="form-control no-role custom-select" id="roles"  required aria-describedby="validationServer03Feedback">
                                                                            <option value="" selected="selected">Select User Type</option>
                                                                            <option value="1">Admin</option>
                                                                            <option value="2">Citizen</option>
                                                                        </select>
                                                                    </div>
                                                                    <input name="first_name" type="hidden" value="{{ $citizen->first_name }}">
                                                                    <input name="last_name" type="hidden" value="{{ $citizen->last_name }}">
                                                                    <div class="form-group">
                                                                        <label>Email:</label>
                                                                        @if($citizen->email != null)
                                                                            <input name="email" class="form-control" type="email" value="{{ $citizen->email }}">
                                                                        @else
                                                                            <input name="email" class="form-control" type="email" value="" required>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group mb-4">

                                                                        <label>Password:</label>
                                                                        <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="new-password">
                                                                        <span class="text-danger error-text purok_name_error"></span>
                                                                    </div>
                                                                    <div class="form-group mb-4">
                                                                        <label>Confirm Password:</label>
                                                                        <input type="password"  name="password_confirmation"  class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="new-password"
                                                                        <span class="text-danger error-text purok_name_error"></span>
                                                                    </div>
                                                                    <div class="form-group mb-4 userBtn">
                                                                        <button type="submit" class="btn btn-sm btn-primary">Activate User Access</button>
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
                                                                    <form action="" method="">
                                                                        @foreach($permissions as $permission)
                                                                            <div class="form-check icheck-primary">
                                                                                <input name="permission[]" class="form-check-input" type="checkbox" value="" id="{{ $permission->id }}" />
                                                                                <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                        <div class="form-group mt-5 text-right">
                                                                            <button type="submit" class="btn btn-sm btn-primary">Activate User Access</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <style>
        .post{
            color: black !important;
        }
        #permissionDiv{
            display: none;
        }

        #citizenPermission{
            display: none;
        }

        .editData{
            width: 100% !important;
            line-height: 0 !important;
            text-indent: 28px !important;
            border: none;
            background: none !important;
        }

        .form-control:disabled {

            width: 20% !important;
        }

        /*}*/
        /*.list-group .list-group-item{*/
        /*    border: none !important;*/
        /*}*/

    </style>
    <script>
        $(function(){
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });


        // $(document).ready(function(){
        //     $('#NoUserId').submit(function(){
        //         if ($('input:checkbox').filter(':checked').length < 1){
        //             alert("Please Check at least one Check Box");
        //             return false;
        //         }
        //     });
        // });


        $(document).ready(function (){

            $('#change_profile').on('click', function(){
                $('#profile_img').click();
            });

            var id = $('#citizen_id').val();

            $('#profile_img').ijaboCropTool({
                preview : '',
                setRatio:1,
                allowedExtensions: ['jpg', 'jpeg','png'],
                buttonsText:['CROP','QUIT'],
                buttonsColor:['#30bf7d','#ee5155', -15],
                processUrl: '{{ route('citizen.updateProfile') }}',
                withCSRF:['_token','{{ csrf_token() }}'],
                onSuccess:function(){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile photo updated successfully',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                onError:function(message, element, status){
                    Swal.fire({
                        icon: 'error',
                        title: message,
                        text: 'File type should be JPG,JPEG or PNG',
                        showConfirmButton: true,
                        timer: 5000
                    })
                }
            });
        })


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
                $('.edit').removeAttr('disabled');
                $('.edit').addClass('form-control');
                $('.edit').removeClass('.editData')

            })

            $('#citizenRole').on('change', function(){
                if(this.value == '1'){
                    $('#citizenPermission').show();
                    $('.userBtn').hide();
                }
                else{
                    $('.userBtn').show();
                    $('#citizenPermission').hide();
                }
            })
        });
    </script>
@endsection
