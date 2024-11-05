<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    public function events()
    {
        return $this->hasMany(Events::class, 'type_event_id');
    }

    public function devices()
    {
        // O mesmo relacionamento em sentido inverso
        return $this->belongsToMany(Device::class, 'device_event_types', 'event_type_id', 'device_id');
    }
}
