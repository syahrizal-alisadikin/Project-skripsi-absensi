<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\MatakuliahImport;
use App\Models\Matakuliah;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = Matakuliah::all();
        return view('pages.admin.matakuliah.index',compact('matkul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Matakuliah::create([
            'name' => $request->name,
            'sks' => $request->sks,
            'id_matkul' => $request->id_matkul,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('matkul.index')->with('success','data berhasil ditambahkan !!');
    }

    public function ImportMatakuliah(Request $request)
    {
        $this->validate($request, [
            'matakuliah' =>  'required|mimes:csv,xls,xlsx'
        ]);
       
        $file = $request->file('matakuliah');
        
        
        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        $import = Excel::import(new MatakuliahImport(),storage_path('app/public/excel/'. $nama_file));
        
        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('matkul.index')->with('success','data berhasil ditambahkan !!');

        } else {
            //redirect
           return redirect()->route('matkul.index')->with('error','Data Gagal Diimport!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $matkul = Matakuliah::find($id);
       $pertemuan = Pertemuan::where('fk_matkul_id',$id)->with('matakuliah')->orderBy('tanggal','asc')->get();

       return view('pages.admin.matakuliah.pertemuan',compact('matkul','pertemuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $matkul = Matakuliah::find($id);
        $matkul->update([
            'name' => $request->name,
            'sks' => $request->sks,
            'id_matkul' => $request->id_matkul,
            'tahun' => $request->tahun,
        ]);

        if ($matkul) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
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
        $matkul = Matakuliah::find($id);
        $matkul->delete();

        if ($matkul) {
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
