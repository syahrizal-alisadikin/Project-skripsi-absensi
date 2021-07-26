<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class DosenImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
          if(isset($row['nidn']) && isset($row['name']) && isset($row['email']) && isset($row['telp']) && isset($row['alamat']) )
        {

            $dosen = Dosen::where('nidn',$row['nidn']);

            if($dosen->count()){

            }else{

                return new Dosen([
                'nidn'          => $row["nidn"],
                'name'          => $row['name'],
                'email'         => $row['email'],
                'phone'         =>$row['telp'],
                'alamat'        =>$row['alamat'],
                'password'      => Hash::make($row['nidn']),
                ]);
            }
        }
    }
}
