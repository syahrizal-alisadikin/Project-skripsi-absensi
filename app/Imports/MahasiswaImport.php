<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Mahasiswa([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'    => $row['phone'],
            'nim'      => $row['nim'],
            'fk_semester_id' => 1,
            'fk_jurusan_id' => 1,
            'password' => Hash::make('nim'),
        ]);
       
    }
}
