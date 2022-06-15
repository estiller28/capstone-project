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
        'picture',
        'barangay_official'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function getPictureAttribute($value)
    {
        if($value){
            return asset('user/'. $value);
        }else{
            return asset('user/avatar.png');
        }

    }



//    relationships
    public function user(){
      return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangay_id', 'id')->withDefault();
    }
    public function purok(){
        return $this->belongsTo(Purok::class , 'purok_id', 'id')->withDefault();
    }

//    public function getAttribute($value){
//        if($value){
//            return asset('storage/profile-photos/'. $value);
//        }else{
//            return asset('storage/profile-photos/');
//        }
//    }

}


