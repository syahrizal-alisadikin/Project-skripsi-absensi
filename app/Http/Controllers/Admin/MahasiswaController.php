<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan','semester')->get();
        return view('pages.admin.mahasiswa.index',compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester = Semester::all();
        $jurusan = Jurusan::all();
        return view('pages.admin.mahasiswa.create',compact('semester','jurusan'));
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
                    'nim'    => 'required',
                    'name'    => 'required',
                    'email'    => 'required|email|unique:mahasiswa,email',
                    'phone'   => 'required|min:10|max:13|unique:mahasiswa,phone',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );

              Mahasiswa::create([
                'nim' => $request->nim,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'fk_semester_id' => $request->fk_semester_id,
                'fk_jurusan_id' => $request->fk_jurusan_id,
                'password' => Hash::make($request->password)
            ]);

        return redirect()->route('mahasiswa.index')->with('success','data berhasil ditambahkan !!');
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semester = Semester::all();
        $jurusan = Jurusan::all();
        return view('pages.admin.mahasiswa.edit',compact('mahasiswa','semester','jurusan'));
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
            $mahasiswa = Mahasiswa::findOrFail($id);

            $this->validate(
                $request,
                [
                    'nim'    => 'required',
                    'name'    => 'required',
                    'email'   => [
                        'required',
                        Rule::unique('mahasiswa')->ignore($mahasiswa->id, 'id'),


                        ],
                    'phone'   => 'required|min:10|max:13',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );

           
            $mahasiswa->update([
                'nim' => $request->nim,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'fk_semester_id' => $request->fk_semester_id,
                'fk_jurusan_id' => $request->fk_jurusan_id,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('mahasiswa.index')->with('success','data berhasil diupdate !!');

        } else{
            $mahasiswa = Mahasiswa::findOrFail($id);

            $this->validate(
                $request,
                [
                    'nim'    => 'required',
                    'name'    => 'required',
                     'email'   => [
                        'required',
                        Rule::unique('mahasiswa')->ignore($mahasiswa->id, 'id'),


                        ],
                    'phone'   => 'required|min:10|max:13',
                ]
            );

            $mahasiswa->update([
                'nim' => $request->nim,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'fk_semester_id' => $request->fk_semester_id,
                'fk_jurusan_id' => $request->fk_jurusan_id,
            ]);
            return redirect()->route('mahasiswa.index')->with('success','data berhasil diupdate !!');

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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        if ($mahasiswa) {
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