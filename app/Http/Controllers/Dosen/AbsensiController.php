<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Absen;
use App\Models\Jadwal;
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
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->orderBy('tanggal','asc')->get();
        $matkul = Matakuliah::findOrFail($id);
        return view('pages.dosen.absen.pertemuan',compact('pertemuan','matkul'));
    }

    public function mahasiswaAbsen(Request $req,$id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        date_default_timezone_set("Asia/Bangkok");
        $warning = strtotime(date('Y-m-d H:i:s'). "+ 30 minute");
        $newWarning = date('Y-m-d H:i:s',$warning);

         // dd($telat);
        if($pertemuan){
            if($pertemuan->expired_absen == null){
                return redirect()->route('absensi.pertemuan-show',$id)->with('info','absen belum di buat!!');
            }
             $time = strtotime($pertemuan->expired_absen);
             $telat = strtotime($pertemuan->expired_absen. "+ 30 minute");
             $date = strtotime(date('Y-m-d H:i:s'));
            if($date <= $time){
                $siswa = auth()->guard('api')->user();
                $getAbsen = Absen::where("fk_pertemuan_id",$id)->where('fk_mahasiswa_id',$req->fk_mahasiswa_id)->count();
                if($getAbsen > 1){
                    return redirect()->route('absensi.pertemuan-show',$id)->with('info','anda sudah absen!!');

                }
                $absen = Absen::create([
                    "fk_pertemuan_id" => $id,
                    "fk_mahasiswa_id" => $req->fk_mahasiswa_id,
                    "status" => "hadir",
                    "waktu" => date('Y-m-d H:i:s')
                ]);
                return redirect()->route('absensi.pertemuan-show',$id)->with('success','absen Berhasil di buat!!');

            } elseif($date >= $time && $date <= $telat ){
                  $siswa = auth()->guard('api')->user();
                  $getAbsen = Absen::where("fk_pertemuan_id",$id)->where('fk_mahasiswa_id',$req->fk_mahasiswa_id)->count();
                if($getAbsen > 1){
                    return redirect()->route('absensi.pertemuan-show',$id)->with('info','absen sudah absen!!');

                }
                $absen = Absen::create([
                    "fk_pertemuan_id" => $id,
                    "fk_mahasiswa_id" => $siswa->id,
                    "status" => "telat",
                    "waktu" => date('Y-m-d H:i:s')
                ]);
            return redirect()->route('absensi.pertemuan-show',$id)->with('success','absen Berhasil di buat!!');

            } elseif($date >= $telat){
                return redirect()->route('absensi.pertemuan-show',$id)->with('info','absen Expired!!');

            }
        }
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
        
        $pertemuan = Pertemuan::find($id);
        
        $kelas = Kelas::where('fk_matkul_id',$pertemuan->fk_matkul_id)->first();
        $mahasiswa = Jadwal::where('fk_kelas_id',$kelas->id)->with('mahasiswa')->get();
        // dd($mahasiswa);
        $absen = Absen::where('fk_pertemuan_id',$id)
                ->whereHas('mahasiswa',function($query){
                    $query->orderBy('nim',"asc");
                })
                ->with('mahasiswa')->pluck('fk_mahasiswa_id')->toArray();
                // dd($absen);
        return view('pages.dosen.absen.pertemuan-absen',compact('absen','id','mahasiswa'));
    }

    public function pertemuanShowAll($id)
    {
        
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->orderBy('tanggal','asc')->get();
       
        $pertemuanPluck = Pertemuan::where('fk_matkul_id',$id)->pluck('id');
        $kelas = Kelas::where('fk_matkul_id',$id)->first();
        $mahasiswa = Jadwal::where('fk_kelas_id',$kelas->id)->with('mahasiswa')->get();
        $absen = Absen::whereIn('fk_pertemuan_id',$pertemuanPluck)
                ->whereHas('mahasiswa',function($query){
                    $query->orderBy('nim',"asc");
                })
                ->with('mahasiswa')->pluck('fk_mahasiswa_id')->toArray();
                // dd($absen);
        return view('pages.dosen.absen.pertemuanAll-absen',compact('absen','id','mahasiswa','pertemuan','pertemuanPluck'));
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
