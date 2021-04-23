<?php

namespace Database\Seeders;

use App\Models\Absen;
use Illuminate\Database\Seeder;

class AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Absen::create([
            'fk_pertemuan_id'       => 1,
            'fk_mahasiswa_id'       => 2,
            'status'                => 'Hadir',
            'waktu'                 => date('Y-m-d h:i:s')
        ]);
    }
}
