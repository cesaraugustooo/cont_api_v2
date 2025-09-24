<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public $token;

    public function __construct(Request $request) {
        $this->token = $request->cookie('jwt_token') ?? null;
    }

    public function register(Request $request){
                $validate = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'password'=>'required|max:8',
                    'nif' => 'required|string',
                ]);
 
                $validate['password'] = Hash::make($validate['password']);
                User::create(array_merge($validate,['nivel_user'=>1]));

                return response()->json(['message'=>'Usuario criado com sucesso']);

        
    }

    public function login(Request $request){
        $creds = $request->validate([
                    'email' => 'required|email',
                    'password'=>'required|max:8',
                ]);
        if(Auth::attempt($creds)){
            $user = User::where('email',$creds['email'])->first();

            $token = $user->createToken('api')->plainTextToken;

            return response()->json(['token'=>$token]);
        }
    }
    public function logout(Request $request){
        auth()->logout();

        $request->user()->curretnAccessToken()->delete();

        return response()->json(['message'=>'Logout efetuado com sucesso']);
    }
}
