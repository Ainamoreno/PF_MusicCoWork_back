<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function getAllRooms()
    {
        try {
            $rooms = Room::query()->get()->toArray();
            return response([
                'success' => true,
                'message' => 'Se han mostrado las salas correctamente.',
                'data' => $rooms
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al mostrar las salas.'
            ], 500);
        }
    }

    public function reserveRoom($id, Request $request)
    {
        try {
            $roomId = $id;
            $userId = auth()->user()->id;
            $roomIsBusy = RoomUser::where('room_id', $roomId)
                ->where('date', $request->get('date'))
                ->where('is_busy', true)
                ->get()
                ->toArray();

            if (count($roomIsBusy) === 1) {
                return response()->json([
                    "success" => false,
                    "message" => 'Lo sentimos, ya tenemos reservada el aula para este día'
                ], 400);
            }

            $validator = Validator::make($request->all(), [
                'date' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => $validator->messages()
                ], 400);
            }

            $reservation = RoomUser::create([
                'user_id' => $userId,
                'room_id' => $roomId,
                'is_busy' => true,
                'date' =>  $request->get('date'),
                'is_delete' => false
            ]);
            return response([
                'success' => true,
                'message' => 'Se ha reservado la sala correctamente.',
                'date' => $reservation

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al reservar la sala.'
            ], 500);
        }
    }

    public function myReservations()
    {
        try {
            $userId = auth()->user()->id;

            $reservation = RoomUser::where('user_id', $userId)
                ->where('is_delete', false)
                ->join('rooms', 'rooms.id', '=', 'room_users.room_id')
                ->select('rooms.id', 'rooms.name', 'room_users.*')
                ->get()
                ->toArray();

            return response([
                'success' => true,
                'message' => 'Se ha accedido a las reservas correctamente.',
                'date' => $reservation

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al mostrar tus reservas.'
            ], 500);
        }
    }

    public function cancelReservation($id)
    {
        try {
            $userId = auth()->user()->id;
            RoomUser::where('user_id', $userId)
                ->where('id', $id)
                ->update(['is_busy' => false]);

            return response([
                'success' => true,
                'message' => 'Se ha cancelado la reserva correctamente.',

            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No se ha podido cancelar la reserva.'
            ], 500);
        }
    }
}
