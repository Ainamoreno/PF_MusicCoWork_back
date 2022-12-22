<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function getAllEvents()
    {
        try {
            $events = Event::query()
            ->where('is_delete', false)
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
}
