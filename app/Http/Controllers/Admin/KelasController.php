<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\KelasImport;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Semester;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('matkul','dosen')->get();
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
       
        $dosen = Dosen::all();
        if(count($matkul) == 0){
            return redirect()->back()->with('info', 'Matakuliah belum ada silahkan tambahkan terlebih dahulu !!');
        }elseif(count($dosen) == 0){
            return redirect()->back()->with('info', 'Dosen belum ada silahkan tambahkan terlebih dahulu !!');
        }
        
        return view('pages.admin.kelas.create',compact('matkul','dosen',));
    }

    public function ImportMahasiswa(Request $request,$id)
    {
        $this->validate($request, [
            'mahasiswa' =>  'required|mimes:csv,xls,xlsx'
        ]);
       
        $file = $request->file('mahasiswa');
        
        
        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        $import = Excel::import(new KelasImport($id),storage_path('app/public/excel/'. $nama_file));
        
        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('kelas.show',$id)->with('success','data berhasil ditambahkan !!');

        } else {
            //redirect
           return redirect()->route('kelas.show',$id)->with('error','Data Gagal Diimport!');
        }
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
        $kelas = Kelas::find($id);
        $jadwal = Jadwal::where('fk_kelas_id',$id)->whereHas('mahasiswa',function($query){
            $query->orderBy('angkatan','asc');
        })->with('mahasiswa.jurusan','mahasiswa.semester')->get();
        // dd($jadwal);
        $mahasiswa = Mahasiswa::orderBy('nim','asc')->get();
        return view('pages.admin.kelas.show-mahasiswa',compact('kelas','jadwal','mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::with('dosen','matkul')->findOrFail($id);
        $matkul = Matakuliah::all();
      
        $dosen = Dosen::all();
        return view('pages.admin.kelas.edit',compact('kelas','matkul','dosen'));
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
