<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Semester;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('matkul','dosen','semester')->get();
        return view("pages.admin.kelas.index",compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $matkul = Matakuliah::all();
        $semester = Semester::all();
        $jurusan = Jurusan::all();
        $dosen = Dosen::all();
        if(count($matkul) == 0){
            return redirect()->back()->with('info', 'Matakuliah belum ada silahkan tambahkan terlebih dahulu !!');
        }elseif(count($semester) == 0){
            return redirect()->back()->with('info', 'Semester belum ada silahkan tambahkan terlebih dahulu !!');
        }elseif(count($jurusan) == 0){
            return redirect()->back()->with('info', 'Jurusan belum ada silahkan tambahkan terlebih dahulu !!');
        }elseif(count($dosen) == 0){
            return redirect()->back()->with('info', 'Dosen belum ada silahkan tambahkan terlebih dahulu !!');
        }
        
        return view('pages.admin.kelas.create',compact('matkul','semester','dosen','jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kelas::create([
            "name" => $request->name,
            "fk_matkul_id" => $request->fk_matkul_id,
            "fk_dosen_id" => $request->fk_dosen_id,
            "fk_semester_id" => $request->fk_semester_id,
            "fk_jurusan_id" => $request->fk_jurusan_id,
        ]);

        return redirect()->route('kelas.index')->with('success','data berhasi ditambahkan !!');
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
        $kelas = Kelas::with('semester','dosen','matkul')->findOrFail($id);
        $matkul = Matakuliah::all();
        $semester = Semester::all();
        $jurusan = Jurusan::all();
        $dosen = Dosen::all();
        return view('pages.admin.kelas.edit',compact('kelas','matkul','dosen','semester','jurusan'));
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
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            "name" => $request->name,
            "fk_matkul_id" => $request->fk_matkul_id,
            "fk_dosen_id" => $request->fk_dosen_id,
            "fk_semester_id" => $request->fk_semester_id,
            "fk_jurusan_id" => $request->fk_jurusan_id,
        ]);

        return redirect()->route('kelas.index')->with('success','data berhasi diupdate !!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
          if ($kelas) {
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
