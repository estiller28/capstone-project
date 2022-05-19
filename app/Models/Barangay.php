<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;
    protected $fillable = ['barangay_name'];

    public function users(){
        return $this->hasMany(User::class)->withDefault();
    }

    public function citizen(){
        return $this->hasMany(Citizen::class);
    }

    public function purok(){
        return $this->hasMany(Purok::class)->withDefault();
    }
}
