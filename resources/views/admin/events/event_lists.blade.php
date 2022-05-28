@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 ">
                    <h1 class="m-0 section-title">Events and Announcements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-4">
                    <div class="card px-xl-2">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-label py-xl-2">Create Event</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="createEvent" action="{{ route('event.create') }}" class="needs-validation" novalidate >
                                @csrf
                                <div class="form-group mb-4">
                                    <label>Event Name</label>
                                    <div class="input-group">
                                        <input type="text" name="event_name" value="{{old('event_name')}}" class="form-control @error('event_name') is-invalid @enderror" id="validationServer"  required aria-describedby="validationServerFeedback">
                                        @if($errors->has('event_name'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('event_name')}}
                                            </div>
                                        @else
                                            <span class="invalid-feedback">
                                                Please input event name
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Start Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control" id="validationServer"  required aria-describedby="validationServerFeedback">
                                                <div class="invalid-feedback">
                                                    Start date is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>End Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control" id="validationServer"  required aria-describedby="validationServerFeedback">
                                                <div class="invalid-feedback">
                                                    End date is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>Start Time</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="time" name="start_time"  value="{{old('start_time')}}" class="form-control datetimepicker-input" data-target="#timepicker" id="validationServer"  required aria-describedby="validationServerFeedback"/>
                                                <div class="invalid-feedback">
                                                    Start time is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>End Time</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="time" name="end_time"  value="{{old('end_time')}}" class="form-control datetimepicker-input" data-target="#timepicker" id="validationServer"  required aria-describedby="validationServerFeedback"/>
                                                <div class="invalid-feedback">
                                                    End time is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Purpose</label>
                                    <div class="input-group">
                                        <textarea name="purpose" class="form-control" id="validationServer"  required aria-describedby="validationServerFeedback"></textarea>
                                        <div class="invalid-feedback">
                                            Purpose is required
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn text-right btn-primary ">Create Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="p-4">
                            <div class="card-body p-0 mt-0">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>

    <script>
        $(function (){
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            $('[data-mask]').inputmask()


            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');

            var announcement = @json($event);
            // console.log(announcement);
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: announcement,
                themeSystem: 'bootstrap',
            });

            calendar.render();
        });

    </script>

    <style>
        .fc-h-event .fc-event-title-container{
            background:  red !important;
        }
        .fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start{
            background: #007BFF !important;
            color: #fff;
        }

    </style>
@endsection

