<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'start_date',
        'end_date',
        'time',
        'description',
        'location',
        'type_event_id'
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'type_event_id');
    }
}