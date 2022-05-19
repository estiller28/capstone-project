
@extends('layouts.admin')

@section('title', 'Purok')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Puroks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addpurok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Purok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('purok.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control"  type="text" name="purok_name" placeholder="Purok name" required>
                        @error('purok_name')
                        <span class="text-danger"> {{ $message }}</span><br>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                    @if(Session('error'))
                        <div class="card bg-danger">
                            <div class="card-header bg-danger">
                                <h3 class="card-title">{{Session('error')}}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-danger" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="flex-1"> <strong>All Purok</strong></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="purok" class="table table table-striped">
                                <thead>
                                <tr>
                                    <td class="table-primary" scope="col">Purok Name </td>
                                    <td class="table-primary" width="20%" scope="col">Action</td>
                                </tr>
                                </thead>

                                @foreach($purok as $puroks)
                                    <tbody>
                                    @if(!$purok->isEmpty())
                                        <tr>
                                            <td>{{$puroks->purok_name}}
                                            <td>

                                                <a href=""><i class="mr-3 text-primary fas fa-edit" title="Edit"></i></a>
                                                <a href=""><i class="mr-3 text-secondary fas fa-eye" title="View"></i></a>
                                                <a href=""><i class="mr-3 text-danger fas fa-archive" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>No purok found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                @endforeach
                            </table>
                            <div class="card mt-4">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addpurok">Add Purok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
