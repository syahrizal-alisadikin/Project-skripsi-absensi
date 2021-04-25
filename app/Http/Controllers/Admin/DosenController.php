<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::all();
        return view('pages.admin.dosen.index',compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
                $request,
                [
                    'name'    => 'required',
                    'email'    => 'required|email|unique:dosen,email',
                    'phone'   => 'required|min:10|max:13|unique:dosen,phone',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );
        Dosen::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dosen.index')->with('success','data berhasil ditambahkan !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('pages.admin.dosen.edit',compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


         if($request->password)
            {
                $dosen = Dosen::findOrFail($id);

                $this->validate(
                    $request,
                    [
                        'name'    => 'required',
                        'email'   => [
                        'required',
                        Rule::unique('dosen')->ignore($dosen->id, 'id'),


                        ],
                        'phone'   => 'required|min:10|max:13',
                        'password' => 'required|min:6|confirmed',
                        'password_confirmation' => 'required',
                    ],
                    [
                        'password.confirmed' => 'Password Tidak sama!',
                    ]
                );

                $dosen->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password)
                ]);
                return redirect()->route('admin.index')->with('success','data berhasil diupdate !!');

            } else{
                $dosen = Dosen::findOrFail($id);
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
                return redirect()->route('dosen.index')->with('success','data berhasil diupdate !!');

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();

        if ($dosen) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
