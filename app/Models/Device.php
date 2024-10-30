<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'events_notification_preferences'
    ];

    protected $casts = [
        'events_notification_preferences' => 'array',
    ];

    public function events()
    {
        return $this->belongsToMany(EventType::class, 'device_event');
    }
}
