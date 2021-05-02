<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class DosController extends Controller
{
   public function index()
    {
        return view('pages.dosen.dashboard');
    }

    public function account()
    {
        $dosen = Auth::guard('dosen')->user();
        return view('pages.dosen.account',compact('dosen'));
    }

    public function updateDosen(Request $request,$id)
    {
        $dosen = Dosen::find($id);
          $this->validate(
                    $request,
                    [
                        'name'    => 'required',
                        'email'   => [
                        'required',
                        Rule::unique('dosen')->ignore($dosen->id, 'id'),


                        ],
                        'phone'   => 'required|min:10|max:13',
                    ]
                );

                $dosen->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return redirect()->route('account')->with('success','data berhasil diupdate !!');
    }

    public function password()
    {
        $dosen = Auth::guard('dosen')->user();
        return view('pages.dosen.password',compact('dosen'));
    }

    public function updatePasswordDosen(Request $request,$id)
    {
        $dosen = Dosen::find($id);
        
                $this->validate(
                    $request,
                    [
                        'password' => 'required|min:6|confirmed',
                        'password_confirmation' => 'required',
                    ],
                    [
                        'password.confirmed' => 'Password Tidak sama!',
                    ]
                );

                $dosen->update([
                    'password' => Hash::make($request->password)
                ]);
                return redirect()->route('password')->with('success','Password berhasil diupdate !!');

    }
    
}
