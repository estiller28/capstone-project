
@extends('layouts.admin')

@section('title', 'Purok')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purok
                        <span>  <i class="ml-2 nav-icon fas fa-chart-area"></i></span>
                    </h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item ">Settings</li>
                        <li class="breadcrumb-item active">Puroks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{--    Add Purok Modal--}}
    <div class="modal fade" id="purok_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Purok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  class="needs-validation" novalidate action="{{ route('purok.store') }}" method="post" id="addPurok">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group add-erorr mb-4">
                            <label>Purok Name</label>
                            <input type="text" name="purok_name" value="" class="form-control" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text purok_name_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade edit-data" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  class="needs-validation" novalidate action="{{ route('purok.update') }}" method="Post" id="updatePurok">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="purokId">
                        <div class="form-group edit-error mb-4">
                            <label>Purok Name</label>
                            <input type="text" name="purok_name" class="form-control validate" id="validationServer03"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text purok_name_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnEdit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="col-md-12">
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
                            <table id="purok_table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td class="table-info font-weight-bold scope="col">Purok Name</td>
                                    <td width="5%" class="table-info font-weight-bold  scope="col">Action</td>
                                </tr>
                                </thead>
                            </table>
                            <div class="card">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#purok_modal">Add Purok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        $(function() {
            //all purok
            $('#purok_table').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "scrollX": false,
                "searching": false, "paging": false, "info": false,
                processing: false,

                ajax: "{{ route('purok.get') }}",
                columns: [
                    {data: 'purok_name', name: 'purok_name'},
                    {data: 'actions', name: 'actions'},
                ]
            })

            //add purok
            $('#addPurok').on('submit', function (e) {
                e.preventDefault();
                var form = this;
                $('#btnSubmit').attr("disabled", true);

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.code == 0) {
                            $('#btnSubmit').removeAttr("disabled");
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        }if(data.code == 1){

                            $(form)[0].reset();
                            $('#purok_table').DataTable().ajax.reload(null, false);
                            $('#addPurok').removeClass('was-validated')
                            $('#purok_modal').modal('hide');
                            toastr.options.progressBar = true;
                            toastr.success(data.msg);
                            $('#btnSubmit').removeAttr("disabled");
                        }
                        if(data.code == 2){
                            $(form)[0].reset();
                            $('.add-erorr').append("<span class='error-text text-danger'>Purok name already exists</span>");
                            $('#btnSubmit').removeAttr("disabled");
                        }
                    }
                });
            });

            //Edit Purok
            $(document).on('click', '#purok_edit', function(e){
                e.preventDefault();

                var purok_id = $(this).data('id');

                $.post('<?= route('purokGet') ?>', {purok_id:purok_id}, function (data){
                    $('.edit-data').find('input[name="purokId"]').val(data.details.id);
                    $('.edit-data').find('input[name="purok_name"]').val(data.details.purok_name);
                    $('.edit-data').modal('show');

                }, 'json');
            });

            //Update Purok
            $('#updatePurok').on('submit', function (e){
                e.preventDefault();
                var form = this;

                $('#btnEdit').attr('disabled', true);

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
                    success: function (data){
                        if(data.code == 0){
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                                $('#btnEdit').attr('disabled', false);
                            });
                        }else if(data.code == 1) {
                            $('.edit-data').find(form)[0].reset();
                            $('#purok_table').DataTable().ajax.reload(null, false);
                            $('#updatePurok').removeClass('was-validated')
                            $('.edit-data').modal('hide');
                            toastr.options.progressBar = true;
                            toastr.info(data.msg);
                            $('#btnEdit').attr('disabled', false);
                        }else{
                            $('.edit-data').find(form)[0].reset();
                            $('.edit-error').append("<span class='error-text text-danger'>The purok name already exists</span>");
                            $('#purok_table').DataTable().ajax.reload(null, false);
                            $('#btnEdit').attr('disabled', false);
                        }
                    }
                });
            });

            //Delete Purok
            $(document).on('click', '#purok-delete', function (e){
                e.preventDefault();

                var purok_id = $(this).data('id');
                var url = '<?= route('purok.delete')  ?>';

                swal.fire({
                    title: "Are you sure?",
                    icon: 'info',
                    html: 'Deleting this <b>Purok</b> will untag those citizens assigned',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#556ee6',
                    width: 500,
                    allowOutsideClick: true
                }).then(function(result){
                    if(result.value){
                        $.post(url, {purok_id: purok_id}, function (data){
                            if(data.code == 1){
                                toastr.options.progressBar = true;
                                $('#purok_table').DataTable().ajax.reload(null, false);
                                toastr.error(data.msg);

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
