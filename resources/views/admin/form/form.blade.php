
@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 ">Generate Forms <span><i class='bx bxs-receipt' ></i></span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Certificates</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 bg-white">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-label">
                                    Generate Certificate
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="" action="{{route('generate_form')}}" method="post" target="_blank">
                                @csrf
                                <div class="form-group">
                                    <label for="select">Select Citizen</label>
                                    <div class="input-group">
                                        <select class="form-control select2" style="width: 100%;" name="citizen" required>
                                            <option value="" selected="selected">--Select Citizen--</option>
                                            @forelse($citizens as $citizen)
                                                <option value="{{$citizen->id}}">{{$citizen->full_name}}</option>
                                            @empty
                                                <option value="">No Citizen found </option>
                                            @endforelse
                                        </select>
                                        @error('citizen')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="select">Select Form</label>
                                    <div class="input-group">
                                        <select class="form-control select2" style="width: 100%;" name="form_name" required>
                                            <option value="" selected="selected">--Select Certificates--</option>
                                            @forelse($certificates as $id => $certificate)

                                                <option value="{{$id}}">{{$certificate}}</option>
                                            @empty
                                                <option value="">No form found </option>
                                            @endforelse
                                        </select>
                                        @error('citizen')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    @if(empty($citizen))
                                        <button type="submit" class="btn btn-primary ml-2" disabled >Generate</button>
                                    @else
                                        <button type="submit" class="btn btn-primary ml-2" >Generate</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function(){
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

    </script>
@endsection
