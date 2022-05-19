<x-app-layout>
    <x-slot name="header">
        <h2 class=" text-xl text-gray-800 leading-tight">
            All Citizen / Update
        </h2>
    </x-slot>

    <style>
        *{
            list-style: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#tabs-1">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dark" href="#tabs-2">Account Access</a>
                    </li>
                </ul>
                <div class="col-md-8" id="tabs-1">
                    <div class="card">
                        <div class="card-header"><strong class="text-lg"> Personal Information</strong> </div>
                        <div class="card-body">
                            <form action="" method="post">
                                @csrf
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-dark-50 font-weight-bold">First Name:</span>
                                        <span class="text-dark-10 text-align-right font-weight-semi">{{$citizen->first_name}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-dark-50 font-weight-bold">Middle Name:</span>
                                        @if(!empty($citizen->middle_name))
                                            <span class="text-dark-10 text-align-right font-weight-semi">{{$citizen->middle_name}}</span>
                                        @else
                                            <span class="text-dark-10 text-align-right font-weight-semi">--</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-dark-50 font-weight-bold">Last Name:</span>
                                        <span class="text-dark-10 text-align-right font-weight-semi">{{$citizen->last_name}}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8" id="tabs-2">
                    <div class="card">
                        <div class="card-header"><strong class="text-lg"> </strong> </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Role</label>
                                <select class="form-control">
                                    <option class="form-control" value="" disabled>Role</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <style>
        .active{
            border: 1px solid blue;
        }
    </style>
    <script>
        $( function() {
            $( "#tabs" ).tabs({
                active: 2
            });
            $(".nav-tabs a").click(function(event){
                e.preventDefault();

                $('.active').removeClass('active');
                $(this).addClass('active');

                var id  = this.id;

                $('.' + id).addClass('active');
            });
        } );
    </script>
</x-app-layout>
