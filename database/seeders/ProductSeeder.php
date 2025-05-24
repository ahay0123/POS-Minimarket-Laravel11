<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            'username' => 'Kasir',
            'password' => 'kasir',
            'role' => 'kasir',
        ];

        DB::table('table_user')->insert($data);

    }
}
