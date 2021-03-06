@extends('layouts.admin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                                {{--                                <img class="profile-user-img img-circle" style="width: 120px; height: 120px;"  src="{{ asset('user/avatar.png') }}" alt="Daniel">--}}
                                <img class="profile-user-img img-circle profile_picture" style="width: 120px; height: 120px;"  src="{{ Auth::user()->picture }}" alt="Daniel">
                            </div>
                            <input type="file" id="profile_img" class="form-control" name="profile_image" style="display: none;">
                            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                            <p class="text-muted text-center">Bsit</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email:</b> <p class="float-right">{{Auth::user()->email}}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile:</b> <p class="float-right">09978839185</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <p class="float-right">Legazpi City, Albay</p>
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
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Account Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <div class="row justify-content-between">
                                            <div class="col-md-6">
                                                <h5 class="mb-4">Personal Information</h5>
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

                                            <div class="col-md-6">
                                                <h5 class="mb-4">Primary Information</h5>
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
                                <!-- /.tab-pane -->
                            {{--                                <div class="tab-pane" id="timeline">--}}
                            {{--                                    Coming soon..--}}
                            {{--                                </div>--}}
                            <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <div class="mb-5 mb-5 mb-5 mb-5 p-0 embed-responsive embed-responsive-16by9" style="height: ">
                                        <iframe class="embed-responsive-item" src="{{ route('profile.show') }}"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>

    </style>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function (){

            $('#change_profile').on('click', function(){
                $('#profile_img').click();
            });

            $('#profile_img').ijaboCropTool({
                preview : '.profile_picture',
                setRatio:1,
                allowedExtensions: ['jpg', 'jpeg','png'],
                buttonsText:['CROP','QUIT'],
                buttonsColor:['#30bf7d','#ee5155', -15],
                processUrl: '{{ route('photo.update') }}',
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
    </script>
@endsection
