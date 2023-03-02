<?php
namespace App\Http\Controllers;

use Laravel\Passport\Passport;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\TransientToken;
use App\Models\User;
use Validator;
use Hash;
use Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email',
            'password' => 'required|integer|min:6',
        ]);
        if($validatedData->fails()){
            return response()->json(["error" => "Register faild"]);
        }else{
            $user = User::create([
                'email' => request('email'),
                'password' => Hash::make(request('password'))
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Register successfully'
            ], 201);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $accessToken = Auth::user()->createToken('API Token')->plainTextToken;

        return response()->json(['access_token' => $accessToken], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
