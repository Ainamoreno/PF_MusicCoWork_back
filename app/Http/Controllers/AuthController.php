<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $email =  $request->get('email');
        $userIsCreate = User::where('email', $email)
            ->where('is_active', false)
            ->get()
            ->toArray();

        $userExist = User::where('email', $email)
            ->where('is_active', true)
            ->get()
            ->toArray();

        if (count($userExist) === 1) {
            return response()->json([
                "success" => false,
                "message" => 'Este email ya había sido utilizado.'
            ], 200);
        }
        if (count($userIsCreate) === 1) {
            $user = User::query()
                ->where('email', $email)

                ->update(['is_active' => true]);

            return response()->json([
                "success" => false,
                "message" => 'Este email ya había sido utilizado, por lo tanto, hemos reactivado la cuenta.'
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->messages()
            ], 200);
        }


        $user = User::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password),
            'is_active' => true,
            'role_id' => 1
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            "success" => false,
            "message" => 'OK',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function profile()
    {
        return response()->json(
            [
                'user' => auth()->user()
            ]
        );
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
