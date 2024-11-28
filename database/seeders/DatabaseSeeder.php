<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'=> 1,
                'nama_lengkap'=>'Admin',
                'username'=>'Admin',
                'email'=>'hasAdmin@admin.com',
                'password' =>Hash::make('adminhebat'),
                'alamat' => 'bumi',
                'role' => 'admin',
            ],
            [
                'id'=> 2,
                'nama_lengkap'=>'Petugas',
                'username'=>'petugas',
                'email'=>'hasPetugas@petugas.com',
                'password' =>Hash::make('petugashebat'),
                'alamat' => 'bumi',
                'role' => 'petugas',
            ],
            [
                'id'=> 3,
                'nama_lengkap'=>'rofiif Nabil',
                'username'=>'rofiif',
                'email'=>'rofiif@gmail.com',
                'password' =>Hash::make('123123123'),
                'alamat' => 'tanjung gadang',
                'role' => 'peminjam',
            ],
            ]);

            DB::table('kategoris')->insert([
                [
                    'id'=> 1,
                    'nama'=>'Pelajaran',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id'=> 2,
                    'nama'=>'Novel',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id'=> 3,
                    'nama'=>'Komik',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id'=> 4,
                    'nama'=>'Majalah',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id'=> 5,
                    'nama'=>'Biografi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id'=> 6,
                    'nama'=>'Dokumenter',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                ]);
    }
}
