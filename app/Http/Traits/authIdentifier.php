<?php
namespace App\Http\Traits;


use Illuminate\Support\Facades\Auth;

trait authIdentifier {

    public function userId(){
        $id = Auth::user()->id;
        return $id;
    }

}
