<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barangay Aquino | Logbook</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,200;1,300&display=swap" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="fs-3 navbar-brand" href="#">Barangay Aquino</a>
        <div class="" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="fs-2 nav-link active" aria-current="page" href="#"> <i class="fas fa-clock"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center">
            <div class="ml-5 camera-circle">
                <div id="my_camera" class="results"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3 text-center mt-sm-5"> <h1 id="time" class="time">Loading...</h1></div>
                <div class="col-md-4 mb-3 text-center mt-md-5"> <h2 id="date" class="date"> </h2></div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-label text-center vertical-align-middle">
                            <h5 class="visitor">Visitors Information</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="logBook" method="post" action="{{ route('visitor.create') }}" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="image" class="image-tag">
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" name="first_name" class="form-control" id="validationCustom01"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text first_name_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="validationCustom02"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text last_name_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="validationCustom02"  required aria-describedby="validationServer03Feedback">
                            <span class="text-danger error-text address_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Contact Number</label>
                            <input type="number" name="phone" class="form-control" id="validationCustom02" value="" required>
                            <span class="text-danger error-text phone_error"></span>
                        </div>
                        <div class="col text-center">
                            <h6 class="text-danger "><strong>Please look at the camera before clicking the Login button.</strong></h6>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button id="btnSubmit" class="btn btn-primary btn-block" type="submit" >Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<style>

    *{
        font-family: 'Poppins', sans-serif;
    }

    .camera-circle {
        background: #fff;
        border: 10px solid #0BA1DD  ;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        position: relative;
        overflow: hidden;
        right: 2%;
        left: 0;
    }
    .error-text{
        font-size: 13px;
        font-weight: 600;
    }
    .form-label{
        font-weight: 600 !important;
    }
    .visitor{
        font-weight: 600;

    }
    #time, #date{
        color: #2256CD;
    }

    i{
        color: #007BFF;
    }

    #my_camera {
        width: 133% !important;
        height: 100% !important;
        margin: auto;
    }

    #my_camera video{
        width: 100% !important;
        height: 100% !important;
    }


</style>

<script>

    function update() {
        $('#time').html( moment().format('hh:mm:ss A'));
        $('#date').html(moment().format('ddd, MMM D, YYYY'));
    }
    setInterval(update, 500);

    $('#formSubmit').on('submit', function (){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'login successfully recorded',
            showConfirmButton: false,
            timer: 1500
        })
    });

    Webcam.set({
        width: 300,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
        } );
    }


    $('#logBook').on('submit', function(e){
        e.preventDefault();

        take_snapshot();

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
            success: function(data){
                if(data.code == 0){
                    $('#btnSubmit').removeAttr("disabled");
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }else if(data.code == 1){
                    $(form)[0].reset();
                    $('#btnSubmit').removeAttr("disabled");
                    $('#logBook').removeClass('was-validated');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Login successfully recorded',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        })

    })

</script>
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>
