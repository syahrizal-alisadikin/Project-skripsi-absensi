<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Matakuliah;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\Http;
class MatkulDosenController extends Controller
{
     public function index()
    {
        $matkul = Matakuliah::whereHas('kelas',function($query){
            $query->where('id',Auth::guard('dosen')->user()->id);
        })->with('kelas.jurusan')->get();
        
        return view('pages.dosen.matakuliah.index',compact('matkul'));
    }

    public function MatkulPertemuan(Request $request,$id)
    {
       $pertemuan = Pertemuan::where('fk_matkul_id',$id)->with('matakuliah')->get();
    //    dd($pertemuan);
        return view('pages.dosen.matakuliah.pertemuan',compact('pertemuan'));

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
