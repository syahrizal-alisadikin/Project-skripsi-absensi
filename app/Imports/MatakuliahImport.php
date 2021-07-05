<?php

namespace App\Imports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatakuliahImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row['id_matkul']) && isset($row['name']) && isset($row['sks']) && isset($row['tahun']) )
        {
            return new Matakuliah([
            'id_matkul'     => $row["id_matkul"],
            'name'          => $row['name'],
            'sks'           => $row['sks'],
            'tahun'         =>$row['tahun'],
            ]);
        }
    }
}
