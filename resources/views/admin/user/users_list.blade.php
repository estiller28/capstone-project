
@extends('layouts.admin')

@section('title', 'Users List')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users List
                        <span> <i class="ml-2 fa-solid fa-user"></i></span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-label">
                                    All Users
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <td class="table-primary" scope="col">ID
                                    <td class="table-primary" scope="col">Name</td>
                                    <td class="table-primary" scope="col">Email</td>
                                    <td class="table-primary" scope="col">Role</td>
                                    <td class="table-primary" width="10%" scope="col">Action</td>
                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tbody>
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $role)
                                                    @if($role == 'Admin')
                                                        <label class="badge badge-success">{{ $role }}</label>
                                                    @else
                                                        <label class="badge badge-info">{{ $role }}</label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#"><i class="mr-3 text-danger fas fa-archive"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
