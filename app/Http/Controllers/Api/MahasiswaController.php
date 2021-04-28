<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

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

    
}
