
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
                    <div class="col-lg-12">
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
                    <div class="col-lg-12">
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
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-gradient-info">
                                <h3 class="card-title">Recently Added Citizens</h3>
                                <div class="card-tools">
                                    <span class="badge badge-danger">8 New Members</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach($recentlyAddedCitizens as $citizen)
                                        <li>
                                            <img src="{{ $citizen->picture }}" alt="User Image">
                                            <a class="users-list-name" href="#">{{ $citizen->first_name. ' '. $citizen->last_name }}</a>
                                            <span class="users-list-date">{{ \Carbon\Carbon::parse($citizen->created_at)->toFormattedDateString()  }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-center mb-3"><a href="javascript:">View All Users</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Recent Visitors</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recentVisitors as $visitor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('/visitors-image/'. $visitor->image) }}" alt="" style="width: 80px;" class=" img-size-32 mr-2">
                                                {{ $visitor->first_name. ' '. $visitor->last_name }}
                                            </td>
                                            <td>
                                                <small class="text-info mr-1">
                                                    <i class="fas fa-calendar"></i>
                                                </small>
                                                {{ \Carbon\Carbon::parse($visitor->created_at)->toFormattedDateString() }}

                                            </td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-clock"></i>
                                                </small>
                                                {{ $visitor->created_at->format('H:i:s')}}
                                            </td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                                {{ $visitor->phone}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

    <style>
        .users-list > li img{
            border-radius: 0 !important;
            max-width: 50% !important;
        }
    </style>

@endsection
