<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'phone',
        'image',
        'barangay_id',
    ];


    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangay_id', 'id')->withDefault();
    }
}
