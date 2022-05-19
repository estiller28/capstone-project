<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
    use HasFactory;


    protected $fillable = [
        'purok_name',
        'barangay_id',

    ];

    public function citizen(){
        return $this->hasMany(Citizen::class, 'id', 'purok_id')->withDefault();
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class);
    }
}
