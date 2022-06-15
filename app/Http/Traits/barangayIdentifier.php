<?php
namespace App\Http\Traits;
use App\Models\Citizen;
use Illuminate\Support\Facades\Auth;

trait barangayIdentifier {

    public function barangayId(){
        $id = Auth::user()->barangay_id;
        return $id;
    }
}
