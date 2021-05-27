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
        if(intval($request->email) > 0){
            return redirect()->back()->with('warning', 'Silahkan Download untuk absensi !!' );
            
        }
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
       
         return $this->respondWithToken($token);
    }

    public function getMahasiswa()
    {
        return response()->json([
            'success' => true,
            "message" => "data mahasiswa " . auth()->guard('api')->user()->name,
            'mahasiswa' => auth()->guard('api')->user()
        ], 200);
    }

    public function refreshToken()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'mahasiswa' => auth()->guard('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 20160
        ]);
    }

    public function LogoutMahasiswa()
    {   
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
           
    }
     
}
