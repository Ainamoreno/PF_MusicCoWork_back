<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function getAllEvents()
    {
        try {
            $events = Event::query()
                ->where('is_active', true)
                ->get()->toArray();
            return response([
                'success' => true,
                'message' => 'Se han podido traer todos los eventos correctamente.',
                'data' => $events

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido acceder a todos los eventos.'
            ], 500);
        }
    }

    public function reserveEvent($id)
    {
        try {
            $userId = auth()->user()->id;
            $eventIsReserve = EventUser::where('user_id', $userId)
                ->where('event_id', $id)
                ->get()
                ->toArray();
                
            if (count($eventIsReserve) === 1) {
                return response()->json([
                    "success" => false,
                    "message" => 'Ya está reservado.'
                ], 200);
            }

            EventUser::create([
                'user_id' => $userId,
                'event_id' => $id,

            ]);
            return response([
                'success' => true,
                'message' => 'Se ha confirmado la asistencia al evento correctamente.'

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido confirmar la asistencia correctamente.'
            ], 500);
        }
    }

    public function myEvents()
    {
        try {
            $userId = auth()->user()->id;

            $myEvents = EventUser::query()
                ->where('user_id', $userId)
                ->join('events', 'events.id', '=', 'event_users.event_id')
                ->select('events.id', 'events.name', 'events.description', 'events.date', 'event_users.*')
                ->orderBy('created_at', 'desc')
                // ->get()
                ->paginate(5)
                ->toArray();
            return response([
                'success' => true,
                'message' => 'Se han podido acceder a las reservas de los eventos correctamente.',
                'data' => $myEvents

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se han podido acceder a tus reservas para los eventos.'
            ], 500);
        }
    }
}
