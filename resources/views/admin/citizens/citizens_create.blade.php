
@extends('layouts.admin')

@section('title', 'Citizens-create')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-between mb-2 pl-2 pr-2">
                <h1 class="m-0">Add Citizens</h1>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('citizen/all')}}">Citizens</a></li>
                    <li class="breadcrumb-item active">Add Citizens</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <form class="needs-validation" novalidate action="{{ route('store.citizen') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center card-header bg-secondary">
                            <strong>Personal Information</strong>
                        </div>
                        <div class="card-body bg-white">
                            <div class="row justify-content-between">
                                <div class="col-md-6 pt-2 pr-xl-4 pl-xl-4">
                                    <div class="mb-3">
                                        <div class="mb-4">
                                            <p>First Name</p>
                                            <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror" id="validationServer03"  required aria-describedby="validationServer03Feedback">

                                            @if($errors->has('first_name'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('first_name')}}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    First name is required
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p>Middle Name</p>
                                        <input type="text" class="form-control"  name="middle_name" value="{{old('middle_name')}}" placeholder="middle name">
                                        @error('middle_name')
                                        <span class="text-danger"> {{ $message }}</span><br>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control" id="validationCustom01" name="last_name" value="{{old('middle_name')}}" required>
                                        @error('last_name')
                                        <span class="text-danger"> {{ $message }}</span><br>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <p>Purok</p>
                                        <select class="form-control" name="purok" id="" >
                                            @forelse($purok as $id => $puroks)
                                                <option value="{{$id}}">{{$puroks}}</option>
                                            @empty
                                                <option disabled>No data</option>
                                            @endforelse
                                        </select>
                                        @error('purok')
                                        <span class="text-danger"> {{ $message }}</span><br>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

    </script>

    <style>
        .bg-primary{
            background-color: #B8DAFF !important;
        }
    </style>

@endsection

