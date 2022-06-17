
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

<div class="container">
    <div class="col-lg-12 mb-5 py-5"></div>
    <div class="col-lg-12 py-5"></div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card px-2 py-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-2 text-center mt-4 ">
                            <h4>Brgy. Management System</h4>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="validationServer01" name="email" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label> <span class="ms-auto"></span>
                            <input type="password" class="form-control" id="validationServer01" name="password" value="{{ old('password') }}" required autocomplete="current-password">
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-block btn-primary ml-2 ">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>

