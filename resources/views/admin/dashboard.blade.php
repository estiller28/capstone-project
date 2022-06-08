
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 ">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item "><a href="{{url('citizen/all')}}">Citizens</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="small-box bg-white py-lg-4 px-lg-4">
                        <div class="inner">
                            <div class="mt-3 mb-2 text-left">
                                <h1>Hi <b><span class="text-info">{{ Auth::user()->name }}!</span></b> </h1>
                            </div>
                            <div class="text-left">
                                <h4 class="text-gray">Welcome back!</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Users</h3>
                            <div class="card-tools">
                                <span class="badge badge-info">8 New Members</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                <li>
                                    <img src="" alt="User Image">
                                    <a class="users-list-name" href="#">Alexander Pierce</a>
                                    <span class="users-list-date">Today</span>
                                </li>
                                <li>
                                    <img src="" alt="User Image">
                                    <a class="users-list-name" href="#">Norman</a>
                                    <span class="users-list-date">Yesterday</span>
                                </li>
                                <li>
                                    <img src="" alt="User Image">
                                    <a class="users-list-name" href="#">Jane</a>
                                    <span class="users-list-date">12 Jan</span>
                                </li>
                                <li>
                                    <img src="" alt="User Image">
                                    <a class="users-list-name" href="#">John</a>
                                    <span class="users-list-date">12 Jan</span>
                                </li>

                            </ul>
                            <div class="text-center mb-2"><a href="javascript:">View All Users</a></div>

                        </div>

                    </div>
                </div>

                {{--                <div class="col-md-3 col-sm-6 col-12">--}}
                {{--                    <div class="info-box">--}}
                {{--                        <span class="info-box-icon bg-info">--}}
                {{--                            <i class="far fa-envelope mr-3"></i></span>--}}
                {{--                        <div class="info-box-content">--}}
                {{--                            <span class="info-box-text">Messages</span>--}}
                {{--                            <span class="info-box-number">1,410</span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{$citizens}}</h3>
                                    <p>Number of Citizens</p>
                                </div>
                                <a href="{{url('citizen/all')}}"  class="small-box-footer bg-info">
                                    <span class="text-white">view all citizens <i class="ml-1 fas fa-arrow-circle-right"></i></span></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{$visitor}}</h3>
                                    <p>Unique Visitors</p>
                                </div>
                                <a href="{{ route('visitor.get') }}"  class="small-box-footer bg-info">
                                    <span class="text-white">view visitors <i class="ml-1 fas fa-arrow-circle-right"></i></span></a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $events }}</h3>
                                    <p>Upcoming Events</p>
                                </div>

                                <a href="{{ url('events/all') }}" class="small-box-footer bg-info">
                                    <span class="text-white">view upcoming events <i class="ml-1 fas fa-arrow-circle-right"></i></span></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $users }}</h3>
                                    <p>Total Number of Users</p>
                                </div>
                                <a href="{{ url('users/list') }}" class="small-box-footer bg-info">
                                    <span class="text-white">view all users <i class="ml-1 fas fa-arrow-circle-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

@endsection
