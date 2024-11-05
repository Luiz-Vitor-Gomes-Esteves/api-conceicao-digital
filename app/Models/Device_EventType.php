<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_EventType extends Model
{
    use HasFactory;

    protected $table = 'device_event_types';

    protected $fillable = [
        'device_id',
        'event_type_id'
    ];
}
