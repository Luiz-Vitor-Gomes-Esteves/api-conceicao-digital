<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'events_notification_preferences',
        'name'
    ];

    protected $casts = [
        'events_notification_preferences' => 'array',
    ];

    public function eventTypes()
    {
        return $this->belongsToMany(EventType::class, 'device_event_types', 'device_id', 'event_type_id');
    }
}
