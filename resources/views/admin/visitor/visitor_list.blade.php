
@extends('layouts.admin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Vistors List
                        <span> <i class="ml-2 fas fa-users"></i></span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Visitors</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex list-button justify-content-between">
                                <div class="flex-1"> <strong>All Citizens</strong></div>
                                <div>
                                    <a href="{{ route('visitor.download') }}" target="_blank" class="btn btn-sm btn-secondary mr-2">
                                        <i class="mr-2 fas fa-download"></i>Download Visitors
                                    </a>
                                    <a href="{{ route('logbook') }}" target="_blank" class="btn btn-sm btn-primary mr-2">
                                        <i class="mr-2 fas fa-sign-in"></i>Proceed to Logbook
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="visitors_table" class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <td class="table-primary" scope="col">ID</td>
                                    <td class="table-primary" scope="col">Image</td>
                                    <td class="table-primary" scope="col">Name</td>
                                    <td class="table-primary" scope="col">Purpose</td>
                                    <td class="table-primary" scope="col">Visitors Address</td>
                                    <td class="table-primary" scope="col">Phone Number</td>
                                    <td class="table-primary" scope="col">Time</td>
                                    <td class="table-primary" scope="col">Date Visited</td>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->id }}</td>
                                        <td> <img src="{{ asset('/visitors-image/'. $visitor->image)  }}"  style="width: 110px; height: 110px;"></td>
                                        <td>{{ $visitor->name }}</td>
                                        <td>{{ $visitor->purpose }}</td>
                                        <td>{{ $visitor->address }}</td>
                                        <td>{{ $visitor->phone }}</td>
                                        <td>{{ $visitor->created_at->format('H:i:s')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($visitor->created_at)->toFormattedDateString() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">No data available in table </td>
                                    </tr>
                                @endforelse
                                </tbody>
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
            $("#visitors_table").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false, "scrollX": false,
                "pageLength": 4,

            });
        });
    </script>

@endsection
