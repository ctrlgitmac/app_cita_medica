<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Usuario;
 
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
        ]);

        $usuario = Usuario::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $jwt = JWTAuth::fromUser($usuario);

        return [
            'success' => true,
            'data' => [
                'user' => $usuario,
                'jwt' => $jwt,
            ],
        ];
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $jwt = JWTAuth::fromUser($user);

            return [
                'success' => true,
                'data' => [
                    'user' => $user,
                    'jwt' => $jwt,
                ],
            ];
        } else {
            $success = false;
            $message = 'Credenciales incorrectas';
            return compact('success', 'message');
        }
    }
    public function logout(){
        Auth::guard('api')->logout();
        $success = true;
        return compact('success');
    }
}