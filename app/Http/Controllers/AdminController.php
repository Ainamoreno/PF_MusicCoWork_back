<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function createRoom(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:255',
                'price' => 'required|integer',
                'horary' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => $validator->messages()
                ], 400);
            }

            $newRoom = Room::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' =>  $request->get('price'),
                'horary' => $request->get('horary'),
                'is_active' => true
            ]);
            return response([
                'success' => true,
                'message' => 'Se ha creado la sala correctamente.',
                'data' => $newRoom

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido crear la sala.'
            ], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $userId = auth()->user()->id;
            $users = DB::table('users')
                ->where('is_active', true)
                ->whereNotIn('id', [$userId])
                ->get();

            return response([
                'success' => true,
                'message' => 'Se han mostrado todos los usuarios correctamente.',
                'data' => $users

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se han podido mostrar los usuarios correctamente.'
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {

            User::where('id', $id)
                ->update(['is_active' => false]);

            return response([
                'success' => true,
                'message' => 'Se ha eliminado el ususario correctamente.'

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido eliminar el ususario.'
            ], 500);
        }
    }

    public function createEvent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:255',
                'date' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => $validator->messages()
                ], 400);
            }

            $newEvent = Event::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'is_active' =>  true,
                'date' => $request->get('date')
            ]);

            return response([
                'success' => true,
                'message' => 'Se ha creado el evento correctamente.',
                'data' => $newEvent

            ], 200);
        } catch (\Throwable $th) {

            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido crear el evento correctamente.'
            ], 500);
        }
    }

    public function deleteEvent($id)
    {
        try {

            Event::where('id', $id)
                ->update(['is_active' => false]);

            return response([
                'success' => true,
                'message' => 'Se ha eliminado el evento correctamente.'

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido eliminar el evento.'
            ], 500);
        }
    }

    public function getAllReservationsRooms()
    {
        try {

            $allReservations = DB::table('room_users')
                ->join('rooms', 'rooms.id', '=', 'room_users.room_id')
                ->join('users', 'users.id', '=', 'room_users.user_id')
                ->select('users.id', 'users.name AS name_user', 'rooms.name AS name_room', 'room_users.*')
                ->get();

            return response([
                'success' => true,
                'message' => 'Se ha accedido correctamente a las reservas de todos los usuarios.',
                'data' => $allReservations

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido acceder a las reservas correctamente.'
            ], 500);
        }
    }

    public function deleteRoom($id)
    {
        try {
            Room::where('id', $id)
                ->update(['is_active' => false]);

            return response([
                'success' => true,
                'message' => 'Se ha eliminado la sala correctamente.',

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido eliminar la sala correctamente.'
            ], 500);
        }
    }

    public function getAllReservationsEvents()
    {
        try {
            $allReservations = DB::table('event_users')
                ->join('events', 'events.id', '=', 'event_users.event_id')
                ->join('users', 'users.id', '=', 'event_users.user_id')
                ->select('users.id', 'users.name AS name_user', 'events.name AS name_event', 'event_users.*')
                ->get();

            return response([
                'success' => true,
                'message' => 'Se ha accedido correctamente a las reservas de todos los usuarios.',
                'data' => $allReservations

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido acceder a las reservas de asistencia de eventos correctamente.'
            ], 500);
        }
    }
}
