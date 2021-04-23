<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Dosen::create([
            'name'      => 'Dosen Kampus',
            'email'     => 'dosen@gmail.com',
            'phone'     => '089649532860',
            'password'  => bcrypt('password')
        ]);
    }
}
