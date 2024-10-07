<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    public function showAll(): mixed
    {
        try{
            $events = Events::with('eventType')->get(); 
            return response()->json($events);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function showEventsByType(Request $request) : mixed
    {
        try{
            $typeEventId = $request->input('typeEventId');
            $eventsType = Events::with('eventType')->where('type_event_id', $typeEventId)->get();
            return response()->json($eventsType);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function create(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'description' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'location' => 'required|string|max:255', 
                'time' => 'required|string',
                'type_event_id' => 'sometimes|required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'errors' => $validator->errors()], 400);
            }
    
            $event = Events::create($request->only([
                'title',
                'subtitle',
                'description',
                'start_date',
                'end_date',
                'location',
                'time',
                'type_event_id',
            ]));
    
            return response()->json($event, 201);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function update(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => ['required','integer', Rule::exists('events')],
                'title' => 'sometimes|string|max:255',
                'subtitle' => 'sometimes|string|max:255',
                'description' => 'sometimes',
                'start_date' => 'sometimes|date',
                'end_date' => 'sometimes|date',
                'location' => 'sometimes|string|max:255',
                'time' => 'string',
                'type_event_id' => 'sometimes|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'errors' => $validator->errors()], 400);
            }

            $event = Events::find($request['id']);
            
            if (!$event) {
                return response()->json(['message' => 'Event not found'], 404);
            }

            $event->update($request->only([
                'title',
                'subtitle',
                'description',
                'start_date',
                'end_date',
                'location',
                'time',
                'type_event_id'
            ]));

            return response()->json($event, 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function delete(Request $request): mixed
    {
        try {
            $event = Events::find($request['id']);
        
            if (!$event) {
                return response()->json(['message' => 'Event not found'], 404);
            }
        
            $event->delete();
        
            return response()->json(['message' => 'Event deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }
}
