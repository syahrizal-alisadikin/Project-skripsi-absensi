<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class LoginController extends Controller
{
    public function AuthDosen()
    {
        return view('auth.login-dosen');
    }

    public function AuthAdmin()
    {
        return view('auth.login-admin');
    }

    public function PostDosen(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
         // Passwordnya pake bcrypt
        if (Auth::guard('dosen')->attempt($login)) {
            return redirect()->route('dashboard-dosen');
        } else {
            return redirect()->route('auth-dosen')->with('error', 'Gagal Login !! Silahkan Periksa Email / Password');
        }
    }

    public function PostAdmin (Request $request)
    {
         $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

         // Passwordnya pake bcrypt
        if (Auth::guard('admin')->attempt($login)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('auth-admin')->with('error', 'Gagal Login !! Silahkan Periksa Email / Password');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
                Auth::guard('admin')->logout();
                return redirect('/login');
            } elseif(Auth::guard('dosen')->check()){
                Auth::guard('dosen')->logout();
                return redirect('/');
            }
    }

     public function PostMahasiswa(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }
       
        return response()->json([
            'success' => true,
            'mahasiswa'  => auth()->guard('api')->user(),  
            'token'   => $token   
        ], 201);
    }

    public function getMahasiswa()
    {
        return response()->json([
            'success' => true,
            "message" => "data mahasiswa " . auth()->guard('api')->user()->name,
            'mahasiswa' => auth()->guard('api')->user()
        ], 200);
    }

     
}
