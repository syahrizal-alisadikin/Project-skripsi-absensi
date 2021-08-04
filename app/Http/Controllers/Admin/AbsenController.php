<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;


class AbsenController extends Controller
{
    public function index()
    {
        $absen = DB::table('absen')
                ->join('pertemuan','pertemuan.id','=' ,'absen.fk_pertemuan_id')
                ->join('matakuliah','matakuliah.id','=','pertemuan.fk_matkul_id')
                ->join('kelas','kelas.id','=','matakuliah.id')
                ->join('dosen','dosen.id','=','kelas.fk_dosen_id')
                ->select(DB::raw('dosen.name as dosen,pertemuan.fk_matkul_id,matakuliah.name as matkul'))
                ->groupBy('pertemuan.fk_matkul_id')
                ->get();
        // dd($absen);
        return view('pages.admin.absensi.index',compact('absen'));
    }

    public function show($id)
    {
        
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->orderBy('tanggal','asc')->get();
        // dd($pertemuan);
        return view('pages.admin.absensi.pertemuan',compact('pertemuan'));

    }

    public function absenPertemuan($id)
    {
        $pertemuan = Pertemuan::find($id);
        $kelas = Kelas::where('fk_matkul_id',$pertemuan->fk_matkul_id)->first();
        $mahasiswa = Jadwal::where('fk_kelas_id',$kelas->id)->with('mahasiswa')->orderBy("nim")->get();
        
        $absen = Absen::where('fk_pertemuan_id',$id)
                ->whereHas('mahasiswa',function($query){
                    $query->orderBy('nim');
                })
                ->with('mahasiswa')->pluck('fk_mahasiswa_id')->toArray();
        // dd($absen);
        return view('pages.admin.absensi.pertemuan-absen',compact('absen','id','mahasiswa'));
    }

    public function print_pdf(Request $req,$id)
    {

        $absen = Absen::where('fk_pertemuan_id',$id)->with('pertemuan.matakuliah','mahasiswa')->first();
        $absens = Absen::where('fk_pertemuan_id',$id)->whereDate('created_at',$req->tanggal_start)->with('pertemuan.matakuliah','mahasiswa')->get();
        $start = $req->tanggal_start;
        // dd($absens);
        $pdf = PDF::loadview('pages.admin.absensi.print-pdf',compact('absen','absens','start'));
        return $pdf->stream();
    }
     public function print_pdf_bulan(Request $req,$id)
    {

        $absen = Absen::where('fk_pertemuan_id',$id)->with('pertemuan.matakuliah','mahasiswa')->first();
        $absens = Absen::where('fk_pertemuan_id',$id)->whereBetween('created_at',[$req->tanggal_start,$req->tanggal_end])->with('pertemuan.matakuliah','mahasiswa')->get();
        // $start = $req->tanggal_start;
        // dd($absens);
        $pdf = PDF::loadview('pages.admin.absensi.print-pdf-bulan',compact('absen','absens'));
        return $pdf->stream();
    }
}
