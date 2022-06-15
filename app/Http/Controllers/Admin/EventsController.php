<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Events;
use Illuminate\Http\Request;
use Humans\Semaphore\Laravel\Facade;
use Humans\Semaphore\Laravel\SemaphoreMessage;
use Humans\Semaphore\Laravel\SemaphoreChannel;
use Humans\Semaphore\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Citizen;

class EventsController extends Controller
{
    public function index(){

        $this->authorize('Events');

        $event = array();
        $allEvents = Events::all('event_name', 'start_date', 'end_date', 'start_time', 'end_time', 'purpose');

        foreach ($allEvents as $events) {
            $event[] = [
                'title' => $events->event_name,
                'start' => $events->start_date. ' '.$events->start_time,
                'end'   => $events->end_date. ' '.$events->end_time,
            ];
        }
        return view('admin.events.event_lists', compact('event'));

    }
    public function createEvent(EventStoreRequest $request){

        $request->validated();
        $data = ([
            'event_name' => $request->event_name,
            'start_date' => $request->start_date,
            'purpose'    => $request->purpose,
            'end_date'   => $request->end_date,
            'start_time' => date('H:i:s' , strtotime($request->start_time)),
            'end_time'   => date('H:i:s' , strtotime($request->end_time)),
            'barangay_id' => Auth::user()->barangay_id,
        ]);
        Events::create($data);

//        $ch = curl_init();
//        $parameters = array(
//            'apikey' => 'c86311822755abc1c4e6af29b7f9903c',
//            'number' => '09109608070',
//            'message' => 'Test sms notification from Daniel ahaha',
//            'sendername' => 'SEMAPHORE'
//        );
//        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
//        curl_setopt( $ch, CURLOPT_POST, 1 );
//
//        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
//
//        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//        $output = curl_exec( $ch );
//        curl_close ($ch);
//
//        echo $output;

        $notification = ([
            'message' => 'Event created successfully',
            'alert-type' => 'success',
        ]);

        return redirect()->back()->with($notification);
    }

    public function sendSMSNotification(){


    }
}
