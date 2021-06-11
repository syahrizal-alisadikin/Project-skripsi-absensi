<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Absen;
use App\Models\Matakuliah;
use PDF;
use Illuminate\Support\Facades\Auth;
class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::where('fk_dosen_id',Auth::guard('dosen')->user()->id)->with('matkul')->get();
        
        return view('pages.dosen.absen.index',compact('kelas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->orderBy('name','asc')->get();
        $matkul = Matakuliah::findOrFail($id);
        return view('pages.dosen.absen.pertemuan',compact('pertemuan','matkul'));
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

    public function pertemuanShow($id)
    {
       $absen = Absen::where('fk_pertemuan_id',$id)
                ->whereHas('mahasiswa',function($query){
                    $query->orderBy('nim',"asc");
                })
                ->with('mahasiswa')->get();
                // dd($absen);
        return view('pages.dosen.absen.pertemuan-absen',compact('absen','id'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
