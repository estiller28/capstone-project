<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\Guard;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Citizen extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'citizens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'email',
        'user_id',
        'barangay_id',
        'purok_id',
    ];
//    relationships
    public function user(){
      return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangay_id', 'id');
    }
    public function purok(){
        return $this->belongsTo(Purok::class , 'purok_id', 'id')->withDefault();
    }
}


