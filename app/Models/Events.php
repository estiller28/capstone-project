<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'purpose',
        'barangay_id',
    ];
}
