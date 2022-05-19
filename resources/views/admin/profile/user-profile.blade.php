@extends('layouts.admin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="change_password" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('password.change') }}" method="Post">
                        @csrf
                        <div class="form-group mb-4">
                            <label>Input Old Password</label>
                            <input type="password" name="oldpassword"  class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text first_name_error"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label>New Password</label>
                            <input type="password" name="newpassword"  class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text first_name_error"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password"  class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text first_name_error"></span>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-circle" style="width: 150px; height: 150px;"  src="{{ Auth::user()->profile_photo_url }}" alt="User profile picture">
                            </div>
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
                                    <b>Address</b> <p class="float-right">Union Gubat Sorsogon</p>
                                </li>
                            </ul>
                            <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#change_password"><b>Change Password</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-4">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">General</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <div class="row justify-content-between">
                                            <div class="col-md-4">
                                                <h5 class="font-weight-bold mb-4">Personal Information</h5>
                                                <ul class="list-group list-group-unbordered mb-3">
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

                                            <div class="col-md-7">
                                                <h5 class="font-weight-bold  mb-4">Primary Information</h5>
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        Name: <a href="#"><p class="float-right">{{Auth::user()->name}}</p></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        Email: <a href="#"><p class="float-right">{{Auth::user()->email}}</p></a>
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

                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">

                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    Coming soon..
                                    {{--                                    <div class="timeline timeline-inverse">--}}
                                    {{--                                        <div class="time-label"><span class="bg-danger">10 Feb. 2014</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <i class="fas fa-envelope bg-primary"></i>--}}

                                    {{--                                            <div class="timeline-item">--}}
                                    {{--                                                <span class="time"><i class="far fa-clock"></i> 12:05</span>--}}

                                    {{--                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>--}}

                                    {{--                                                <div class="timeline-body">--}}
                                    {{--                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,--}}
                                    {{--                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity--}}
                                    {{--                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle--}}
                                    {{--                                                    quora plaxo ideeli hulu weebly balihoo...--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="timeline-footer">--}}
                                    {{--                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>--}}
                                    {{--                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!-- END timeline item -->--}}
                                    {{--                                        <!-- timeline item -->--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <i class="fas fa-user bg-info"></i>--}}

                                    {{--                                            <div class="timeline-item">--}}
                                    {{--                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>--}}

                                    {{--                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request--}}
                                    {{--                                                </h3>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!-- END timeline item -->--}}
                                    {{--                                        <!-- timeline item -->--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <i class="fas fa-comments bg-warning"></i>--}}

                                    {{--                                            <div class="timeline-item">--}}
                                    {{--                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>--}}

                                    {{--                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>--}}

                                    {{--                                                <div class="timeline-body">--}}
                                    {{--                                                    Take me to your leader!--}}
                                    {{--                                                    Switzerland is small and neutral!--}}
                                    {{--                                                    We are more like Germany, ambitious and misunderstood!--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="timeline-footer">--}}
                                    {{--                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!-- END timeline item -->--}}
                                    {{--                                        <!-- timeline time label -->--}}
                                    {{--                                        <div class="time-label">--}}
                                    {{--                                            <span class="bg-success">--}}
                                    {{--                                              3 Jan. 2014--}}
                                    {{--                                            </span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!-- /.timeline-label -->--}}
                                    {{--                                        <!-- timeline item -->--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <i class="fas fa-camera bg-purple"></i>--}}

                                    {{--                                            <div class="timeline-item">--}}
                                    {{--                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>--}}

                                    {{--                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>--}}

                                    {{--                                                <div class="timeline-body">--}}

                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!-- END timeline item -->--}}
                                    {{--                                        <div>--}}
                                    {{--                                            <i class="far fa-clock bg-gray"></i>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    {{--                                    <form class="form-horizontal">--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>--}}
                                    {{--                                            <div class="col-sm-10">--}}
                                    {{--                                                <input type="email" class="form-control" id="inputName" placeholder="Name">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>--}}
                                    {{--                                            <div class="col-sm-10">--}}
                                    {{--                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>--}}
                                    {{--                                            <div class="col-sm-10">--}}
                                    {{--                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>--}}
                                    {{--                                            <div class="col-sm-10">--}}
                                    {{--                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>--}}
                                    {{--                                            <div class="col-sm-10">--}}
                                    {{--                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <div class="offset-sm-2 col-sm-10">--}}
                                    {{--                                                <div class="checkbox">--}}
                                    {{--                                                    <label>--}}
                                    {{--                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>--}}
                                    {{--                                                    </label>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="form-group row">--}}
                                    {{--                                            <div class="offset-sm-2 col-sm-10">--}}
                                    {{--                                                <button type="submit" class="btn btn-danger">Submit</button>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </form>--}}
                                    Coming soon..
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection
