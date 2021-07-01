<?php

namespace App\Imports;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function model(array $row)
    {
        $id = $this->id;
        $mahasiswa = Mahasiswa::where('nim',$row['nim'])->get();
        foreach($mahasiswa as $siswa){
            Jadwal::create([
                'fk_kelas_id' => $id,
                'fk_mahasiswa_id' => $siswa->id
            ]);
        }
    }
}
