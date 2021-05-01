<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;


class AbsenController extends Controller
{
    public function index()
    {
        // $absen = Absen::latest()->with('pertemuan.matakuliah.kelas.dosen')->groupBy()->get();
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
        
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->get();
        return view('pages.admin.absensi.pertemuan',compact('pertemuan'));

    }

    public function absenPertemuan($id)
    {
        $absen = Absen::where('fk_pertemuan_id',$id)->with('mahasiswa')->get();
        return view('pages.admin.absensi.pertemuan-absen',compact('absen'));
        // dd($absen);
    }

    public function print_pdf()
    {
        $pdf = PDF::loadview('pages.admin.absensi.print-pdf');
        return $pdf->stream();
    }
}
