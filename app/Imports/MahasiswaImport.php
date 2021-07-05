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
    
        // $newArr = [];
        if(isset($row['nama_mahasiswa']) && isset($row['nim']) && isset($row['jurusan']) && isset($row['phone']) && isset($row['angkatan']) )
        {
            return new Mahasiswa([
            'name'          => $row["nama_mahasiswa"],
            'nim'           => $row['nim'],
            'jurusan'       => $row['jurusan'],
            'phone'         =>$row['phone'],
            'angkatan'      =>$row['angkatan'],
            'password'      => Hash::make($row['nim']),
        ]);
        }
       
    }

    
}
