<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        try{
            $userId = auth()->user()->id;
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'surname' => 'required',
                'email' => 'string|required'
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $user = User::find($userId);
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');

            if(isset($name)){
                $user->name = $request->input('name');
            }  

            if(isset($surname)){
                $user->surname = $request->input('surname');
            }  

            if(isset($email)){
                $user->email = $request->input('email');
            }
            
            $user -> save();
            return response([
                'success' => false,
                'message' => 'Se ha modificado correctamente el perfil'
            ], 200);

        } catch (\Throwable $th){
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al modificar el perfil'
            ], 500);
        }
    }
}
