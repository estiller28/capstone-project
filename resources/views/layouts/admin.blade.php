{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Barangay | @yield('title') </title>--}}
{{--    <link rel = "icon">--}}

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
{{--    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">--}}


{{--    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">--}}


{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}

{{--</head>--}}

{{--<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">--}}

{{--@include('admin.top-nav')--}}

{{--@include('admin.sidebar')--}}

{{--    <div class="content-wrapper p-xl-2" style="background-color: #F0F1F3 !important;">--}}

{{--    @yield('content')--}}
{{--        <aside class="control-sidebar control-sidebar" >--}}
{{--            <div class="p-3">--}}
{{--                <h5>Title</h5>--}}
{{--                <p>Sidebar content</p>--}}
{{--            </div>--}}
{{--        </aside>--}}
{{--    </div>--}}

{{--<footer class="main-footer">--}}
{{--    <strong class="">Copyright &copy; 2022-2023 <a href="#">Barangay Management System</a>.</strong> All rights reserved.--}}
{{--</footer>--}}

{{--<script>--}}
{{--    // $(window).on('load', function (){--}}
{{--    //     $(".loader-wrapper").fadeOut('slow');--}}
{{--    //--}}
{{--    // }--}}
{{--</script>--}}



{{--<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>--}}

{{--<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}

{{--<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>--}}
{{--<script src="{{ asset('plugins/sweetalert2.min.js')}}"></script>--}}


{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('admin.top-nav')

    @include('admin.sidebar')
    <div class="content-wrapper">
        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">Barangay Management System</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    toastr.options.progressBar = true;
    switch (type){
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;

        case 'success':
            toastr.success("{{Session::get('message')}}");

            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif

</script>

<style>

    .card .bg-danger{
        background: #F8D7DA !important;
        color: #842029 !important;
    }

    @media screen and (max-width: 576px) {
        h1.section-title{
            font-size: 25px !important;
        }
    }

    label{
        font-weight: normal !important;
    }
    .card{
        background-color: #FFFFFF !important;
        border: none!important;
        box-shadow: none;

    }
    .card-label{
        font-weight: 600 !important;
        font-size: 1.2rem;
    }
    .loader-wrapper{
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        background: #fff;
        align-items: center;
    }
    .loader{
        width: 100px;
    }
</style>

</body>
</html>
