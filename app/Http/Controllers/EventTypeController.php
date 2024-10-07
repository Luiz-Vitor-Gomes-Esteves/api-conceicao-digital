<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function showAll(): mixed
    {
        $eventsType = EventType::all(); 
        return response()->json($eventsType);
    }

    
}
