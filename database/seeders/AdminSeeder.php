<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'      => 'Admin Kampus',
            'email'     => 'admin@gmail.com',
            'phone'     => '089649532860',
            'password'  => bcrypt('password')
        ]);
    }
}
