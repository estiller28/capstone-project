
@extends('layouts.admin')

@section('title', 'Test')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-between mb-2 pl-2 pr-2">
                <h1 class="m-0">Test</h1>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Add Citizens</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="modal fade edit-data" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{ route('citizenUpdate') }}" method="post" id="update-citizen-form">
                        @csrf
                        <input type="hidden" name="cid">
                        <div class="form-group mb-4">
                            <label>First Name</label>
                            <input type="text" name="first_name"  class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text first_name_error"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name"  class="form-control">
                            <span class="text-danger error-text middle_name_error"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name"  class="form-control">
                            <span class="text-danger error-text last_name_error"></span>
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Citizen List
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="citizen-table">
                                <thead>
                                <td class="table-primary">ID</td>
                                <td class="table-primary">First Name</td>
                                <td class="table-primary">Middle Name</td>
                                <td class="table-primary">Last Name</td>
                                <td class="table-primary">Actions</td>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Citizen
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('citizen.store') }}" method="post" id="addCitizen">
                                @csrf
                                <div class="form-group mb-4">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                                    <span class="text-danger error-text first_name_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                                    <span class="text-danger error-text middle_name_error"></span>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name"  class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                                    <span class="text-danger error-text last_name_error"></span>
                                </div>


                                <div style="display: none" class="form-group mb-4">
                                    <label>Email</label>
                                    <input type="email" name="email"  class="form-control">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">

            <img src="{{ $profilePhoto }}" alt="">
            <h1>{{ $user->citizen->first_name . ' '. $user->citizen->last_name }}</h1>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Add Citizen
        $(function(){
            $('#addCitizen').on('submit', function(e){
                e.preventDefault();
                var form = this;

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data:new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function (){
                        $(form).find('span.error-text').text('');
                    },
                    success: function (data){
                        if(data.code == 0){
                            $('input').addClass('span.error-text.invalid-feedback');
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);

                            });
                        }else{
                            $(form)[0].reset();
                            toastr.options.progressBar = true;
                            $('#citizen-table').DataTable().ajax.reload(null, false);
                            $('#addCitizen').removeClass('was-validated');
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //All citizens
            $('#citizen-table').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false, "scrollX": false,
                "search": {
                    "caseInsensitive": true,
                },
                "": false,
                processing: true,
                info: true,

                ajax: "{{ route('citizen.get') }}",
                "pageLength": 5,
                "aLengthMenu": [[5,10,15,25,50],[5,10,15,25,50,"All"]],
                columns: [
                    // {data: 'id', name:'id'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'middle_name', name: 'middle_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'actions', name: 'actions'},
                ]
            })

            //Edit citizen
            $(document).on('click', '#citizen_edit', function(e){
                e.preventDefault();

                var citizen_id = $(this).data('id');


                $.post('<?= route('citizenGet') ?>', {citizen_id:citizen_id}, function(data){
                    $('.edit-data').find('input[name="cid"]').val(data.details.id);
                    $('.edit-data').find('input[name="first_name"]').val(data.details.first_name);
                    $('.edit-data').find('input[name="middle_name"]').val(data.details.middle_name);
                    $('.edit-data').find('input[name="last_name"]').val(data.details.last_name);
                    $('.edit-data').modal('show');

                }, 'json');
            });

            //Update Citizen
            $('#update-citizen-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data:new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.code == 0) {
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        }else {
                            $('.edit-data').find(form)[0].reset();
                            $('#citizen-table').DataTable().ajax.reload(null, false);
                            $('#update-citizen-form').removeClass('was-validated')
                            $('.edit-data').modal('hide');
                            toastr.options.progressBar = true;
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //Delete Citizen
            $(document).on('click', '#citizen_delete', function (e){
                e.preventDefault();
                var citizen_id = $(this).data('id');

                var url = '<?= route('citizenDelete') ?>';

                swal.fire({
                    title: "Are you sure?",
                    icon: 'info',
                    html: 'You want to <b>Delete</b> this citizen',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#556ee6',
                    width: 500,
                    allowOutsideClick: false
                }).then(function(result){
                    if(result.value){
                        $.post(url, {citizen_id: citizen_id}, function (data){
                            if(data.code == 1){
                                toastr.success(data.msg);
                                toastr.options.progressBar = true;
                                $('#citizen-table').DataTable().ajax.reload(null, false);

                            }else{
                                toastr.error(data.msg);
                                toastr.options.progressBar = true;
                            }
                        }, 'json');
                    }
                });
            });

        });
    </script>

    <style>
        .error-text{
            font-size: 13px;
        }
    </style>
@endsection
