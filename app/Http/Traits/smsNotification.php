<?php
namespace App\Http\Traits;
use App\Models\Citizen;
trait smsNotification {
    public function sendSMS() {
      $citizen = Citizen::all();

      return $citizen;
    }
}
