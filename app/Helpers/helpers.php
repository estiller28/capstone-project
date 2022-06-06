<?php

use Illuminate\Support\Facades\Auth;

if(function_exists('barangay_id')){
    function barangay_id(){
        $brgy = Auth::user()->barangay_id;

        return $brgy;
    }
}
