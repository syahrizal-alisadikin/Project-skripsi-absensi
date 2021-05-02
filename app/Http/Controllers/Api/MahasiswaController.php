<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use DateTime;
class MahasiswaController extends Controller
{
    public function kelas ()
    {
        $mahasiswa = auth()->guard('api')->user();

        $kelas = Kelas::where('fk_semester_id',$mahasiswa->fk_semester_id)->where('fk_jurusan_id',$mahasiswa->fk_jurusan_id)->with('semester','dosen','matkul')->get();
        return response()->json([
            'success' => true,
            'message' => "kelas berhasil diambil",
            'data' => $kelas
        ], 200);
    }

    public function pertemuan($id)
    {
        $pertemuan = Pertemuan::where('fk_matkul_id',$id)->with('absen')->get();

         return response()->json([
            'success' => true,
            'message' => "pertemuan berhasil diambil",
            'data' => $pertemuan
        ], 200);
    }


    public function absensi($id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        date_default_timezone_set("Asia/Bangkok");
        $warning = strtotime(date('Y-m-d H:i:s'). "+ 30 minute");
        $newWarning = date('Y-m-d H:i:s',$warning);
        
        
        

        // dd($telat);
        if($pertemuan){
            if($pertemuan->expired_absen == null){
                return response()->json([
                'success' => false,
                'message' => "absen Belum di buat",
                
                ], 409);
            }
             $time = strtotime($pertemuan->expired_absen);
             $telat = strtotime($pertemuan->expired_absen. "+ 30 minute");
             $date = strtotime(date('Y-m-d H:i:s'));
            if($date <= $time){
                $siswa = auth()->guard('api')->user();
                $absen = Absen::create([
                    "fk_pertemuan_id" => $id,
                    "fk_mahasiswa_id" => $siswa->id,
                    "status" => "hadir",
                    "waktu" => date('Y-m-d H:i:s')
                ]);
                return response()->json([
                'success' => true,
                'message' => "absen success",
                'data' => $absen
                
                ], 200);
            } elseif($date >= $time && $date <= $telat ){
                  $siswa = auth()->guard('api')->user();
                $absen = Absen::create([
                    "fk_pertemuan_id" => $id,
                    "fk_mahasiswa_id" => $siswa->id,
                    "status" => "telat",
                    "waktu" => date('Y-m-d H:i:s')
                ]);
                return response()->json([
                'success' => true,
                'message' => "absen telat",
                'data' => $absen
                
                ], 200);
            } elseif($date >= $telat){
                return response()->json([
                'success' => false,
                'message' => "absen Expired",
                
                ], 409);
            }
        }
    }

    
}
