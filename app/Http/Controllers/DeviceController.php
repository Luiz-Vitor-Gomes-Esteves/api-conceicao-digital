<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    public function showAll(): mixed
    {
        try{
            $events = Device::all();
            return response()->json($events);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function create(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'events_notification_preferences' => 'sometimes|required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'errors' => $validator->errors()], 400);
            }

            $event = Device::create($request->only([
                'name'
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
                'id' => ['required','integer', Rule::exists('devices')],
                'name' => 'sometimes|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'errors' => $validator->errors()], 400);
            }

            $event = Device::find($request['id']);

            if (!$event) {
                return response()->json(['message' => 'Device not found'], 404);
            }

            $event->update($request->only([
                'name',
            ]));

            return response()->json($event, 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function delete(Request $request): mixed
    {
        try {
            $event = Device::find($request['id']);

            if (!$event) {
                return response()->json(['message' => 'Device not found'], 404);
            }

            $event->delete();

            return response()->json(['message' => 'Device deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }

    public function updateNotificationEventsPreferences()
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => ['required','integer', Rule::exists('devices')],
                'name' => 'sometimes|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'errors' => $validator->errors()], 400);
            }

            $event = Device::find($request['id']);

            if (!$event) {
                return response()->json(['message' => 'Device not found'], 404);
            }

            $event->update($request->only([
                'name',
            ]));

            return response()->json($event, 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage(),'errors'=> $th->getMessage()],500);
        }
    }
}
