<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'nama_petugas' => 'Administrator',
            'username' => 'admin',
            'telp' => '081220423665',
            'password' => bcrypt('admin123'),
            'level' => 'admin'
        ]);

        Petugas::create([
            'nama_petugas' => 'Petugas Aulia',
            'username' => 'petugas',
            'telp' => '081220423665', 
            'password' => bcrypt('petugas123'),
            'level' => 'petugas'
        ]);
    }
}
