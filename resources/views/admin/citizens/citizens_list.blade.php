
@extends('layouts.admin')

@section('title', 'Citizen')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Citizens
                        <span> <i class="ml-2 fas fa-users"></i></span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Citizens</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop"  data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recycle Bin (Deleted Citizens)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table-primary" scope="col">ID
                            <td class="table-primary" scope="col">First Name</td>
                            <td class="table-primary" scope="col">Middle Name</td>
                            <td class="table-primary" scope="col">Last Name</td>
                            <td class="table-primary" scope="col">Date Deleted</td>
                            <td class="table-primary" scope="col">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$deleted_citizens->isEmpty())
                            @foreach($deleted_citizens as $citizen)
                                <tr>
                                    <td>{{$citizen->id}}</td>
                                    <td>{{$citizen->first_name}}</td>
                                    <td>{{$citizen->middle_name}}</td>
                                    <td>{{$citizen->last_name}}</td>
                                    <td>{{$citizen->deleted_at}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('citizen/restore/'.$citizen->id)}}">Restore</a>
                                        <a class="btn btn-danger" href="{{url('citizen/force-delete/'.$citizen->id )}}">Delete Permanently</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{$deleted_citizens->links()}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Restore All</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload-Template trigger modal -->
    <div class="modal fade" id="upload_citizens" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header sm">
                    <h5 class="modal-title" id="exampleModalLabel">Import Citizen File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('import.citizen') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <p class="text-danger"><strong>Reminders:</strong> </p>
                        </div>
                        <div>
                            <ul class="upload_citizen">
                                <li class="mb-2">1. Please <a href="{{ url('citizen/template/download') }}" target="_blank" >Download <span><i class='mr-2 fas fa-download'></i></span> </a> the latest Import Citizens Template</li>
                                <li class="mb-2">2. Be careful not to modify the Headers of the template.</li>
                                <li class="mb-2">3. Date format must be <span class="text-danger">(dd/mm/yy)</span>.</li>
                                <li class="mb-2">4. The system accepts .xls, .xlsx, .csv file extensions only.</li>
                                <li class="mb-4">5. Failure to do the above instructions will throw an error.</li>
                            </ul>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input class="form-control" type="file" name="template">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><span class="mr-2"><i class='fas fa-upload mr-1' ></i></span>Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                        <div class="card-header">
                            <div class="d-flex list-button justify-content-between">
                                <div class="flex-1"> <strong>All Citizens</strong></div>
                                <div>
                                    <a href="{{ route('add.view') }}" class="btn btn-info btn-sm mr-2">
                                        <i class="mr-2 fas fa-user-plus"></i> Add Citizens </a>
                                    <a href="#upload_citizens" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#upload_citizens">
                                        <i class='mr-2 fa fa-upload' ></i>Upload Citizens List </a>
                                    <a href="{{ route('export.citizen') }}" target="_blank" class="btn btn-sm btn-primary mr-2">
                                        <i class="mr-2 fa fa-download" aria-hidden="true"></i> Download Citizens List</a>
                                    <a href="" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#staticBackdrop">
                                        <i class="mr-2 fas fa-trash-restore-alt"></i>View Archived Citizens</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <td class="table-primary" scope="col">ID
                                    <td class="table-primary" scope="col">First Name</td>
                                    <td class="table-primary" scope="col">Middle Name</td>
                                    <td class="table-primary" scope="col">Last Name</td>
                                    <td class="table-primary" scope="col">Purok</td>
                                    <td class="table-primary" scope="col">Email</td>
                                    <td class="table-primary" scope="col">Date Of Birth</td>
                                    <td class="table-primary" width="8%">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$citizens->isEmpty())
                                    @foreach($citizens as $citizen)
                                        <tr>
                                            <td>{{$citizen->id}}</td>
                                            <td>{{$citizen->first_name}}</td>
                                            <td>{{$citizen->middle_name}}</td>
                                            <td>{{$citizen->last_name}}</td>
                                            <td>{{$citizen->purok->purok_name}}</td>
                                            <td>{{$citizen->user->email}}</td>

                                            @if($citizen->date_of_birth !== null)
                                                <td>{{ \Carbon\Carbon::parse($citizen->date_of_birth)->toFormattedDateString()  }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                <a href="{{url('citizen/edit/ '.$citizen->id)}}"><i class="mr-3 text-primary fas fa-edit"></i></a>
                                                <a id="archiveCitizen" href="{{url('citizen/delete/'.$citizen->id )}}"><i class="mr-3 text-danger fas fa-archive"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">No data available</td>
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false, "scrollX": false,
                "search": {
                    "caseInsensitive": true,
                },
                "": false,
            });
        });

        // $('#archiveCitizen').on('click', function (){
        //     e.preventDefault();
        //
        //     alert('clicked');
        // })
    </script>


    <style>

        .form-control:hover{
            cursor: pointer !important;
        }
        .upload_citizen{
            list-style: none;
        }
        /*.fa-trash-restore-alt{*/
        /*    font-size: 30px !important;*/
        /*    color: blue;*/
        /*}*/
    </style>
@endsection
