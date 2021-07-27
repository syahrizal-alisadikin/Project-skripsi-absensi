<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Matakuliah;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\Http;
class MatkulDosenController extends Controller
{
     public function index()
    {
        // $matkul = Matakuliah::whereHas('kelas',function($query){
        //     $query->where('id',Auth::guard('dosen')->user()->id);
        // })->with('kelas')->get();
        $matkul = Kelas::where('fk_dosen_id',Auth::guard('dosen')->user()->id)->with('matkul','jadwal.mahasiswa.jurusan')->get();
        // dd($matkul);
        return view('pages.dosen.matakuliah.index',compact('matkul'));
    }

    public function MatkulPertemuan(Request $request,$id)
    {
       $pertemuan = Pertemuan::where('fk_matkul_id',$id)->with('matakuliah')->orderBy('tanggal','asc')->get();
        // dd($pertemuan);
        return view('pages.dosen.matakuliah.pertemuan',compact('pertemuan'));

    }

    public function update(Request $request,$id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        if($pertemuan){
              $pertemuan->update([
                    'name' => $request->name,
                    'tanggal' => $request->tanggal,
                ]);
            return redirect()->route('matakuliah.pertemuan',$pertemuan->fk_matkul_id)->with('success','data berhasil diupdate!!');
        }
            return redirect()->route('matakuliah.pertemuan',$pertemuan->fk_matkul_id)->with('info','data gagal diupdate!!');


    }

    public function MatkulMahasiswa($id)
    {
        $jadwal = Jadwal::where('fk_kelas_id',$id)->with('mahasiswa')->get();
        // dd($jadwal);
        return view('pages.dosen.matakuliah.mahasiswa',compact('jadwal'));
    }

    public function generateAbsen($id)
    {
        $pertemuan = Pertemuan::find($id);
        date_default_timezone_set("Asia/Bangkok");
        $warning = strtotime(date('Y-m-d H:i:s'). "+ 60 minute");
        $newWarning = date('Y-m-d H:i:s',$warning);
      
        $pertemuan->update([
            'expired_absen' => $newWarning
        ]);
        return view("pages.dosen.absen.generate-absen",compact('pertemuan'));
    }

    public function AddTimeAbsen($id)
    {
        $pertemuan = Pertemuan::find($id);
        date_default_timezone_set("Asia/Bangkok");
        $warning = strtotime(date('Y-m-d H:i:s'). "+ 60 minute");
        $newWarning = date('Y-m-d H:i:s',$warning);
        $pertemuan->update([
            'expired_absen' => $newWarning
        ]);
        return redirect()->route('matakuliah.pertemuan',$pertemuan->fk_matkul_id)->with('success','Waktu berhasil Ditambahkan !!');
    }   

    public function generateView($id)
    {
        $pertemuan = Pertemuan::find($id);
       
        return view("pages.dosen.absen.generate-absen",compact('pertemuan'));
    }

    
}
