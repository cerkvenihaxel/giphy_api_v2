<?php

namespace App\Http\Controllers;

use App\Traits\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use App\Traits\ApiResponse;
use function Laravel\Prompts\password;
use Laravel\Passport\HasApiTokens;


class AuthController extends Controller
{
    use ApiResponse;
    use ValidatorResponse;
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($response = $this->validationFails($validator)) {
            return $response;
        }

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return $this->invalid('Invalid email or password');
        }

        $user = $request->user();
        $token = $user->createToken('Access Token');
        $user->access_token = $token->accessToken;
        $user->token_type = 'Bearer';
        $user->expires_at = 'Token expires at '.now()->addMinutes(30);

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($response = $this->validationFails($validator)) {
            return $response;
        }

        try {
            $username = $request->input('name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));

            $newUser = new User();
            $newUser->name = $username;
            $newUser->email = $email;
            $newUser->password = $password;
            $newUser->email_verified_at = now();
            $newUser->remember_token = Str::random(10);
            $newUser->save();

            return $this->success('User created succesfully');

        } catch (\Exception $e){
         return response()->json([
             'message' => 'An error occurred while creating the user',
             'error' => $e->getMessage()
         ], 500);
        }

    }
}
