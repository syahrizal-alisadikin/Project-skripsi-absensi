<?php

namespace App\Exports;

use App\Models\Pertemuan;
use App\Models\Kelas;
use App\Models\Jadwal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PertemuanExport implements FromView,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $pertemuan = Pertemuan::where('fk_matkul_id', $this->id)->orderBy('tanggal','asc')->get();
        $pertemuanPluck = Pertemuan::where('fk_matkul_id',$this->id)->pluck('id');

        $kelas     = Kelas::where('fk_matkul_id',$this->id)->with('matkul')->first();
        $mahasiswa = Jadwal::where('fk_kelas_id',$kelas->id)->with('mahasiswa')->get();
        return view('exports.pertemuan', compact('pertemuan','kelas','mahasiswa','pertemuanPluck'));
    }

   
}
