<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function createRoom(Request $request)
    {
        try {
            $newRoom = Room::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' =>  $request->get('price'),
                'horary' => $request->get('horary')
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
            ->where('is_delete', false)
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
                ->update(['is_delete' => true]);

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
}
