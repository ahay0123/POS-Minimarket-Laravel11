<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'nama_categories' => 'Makanan',
            'description' => 'Makanan Berat',
        ];

        DB::table('categories')->insert($data);

        $data = [
            'nama_categories' => 'Makanan',
            'description' => 'Makanan Berat',
        ];

        DB::table('categories')->insert($data);
    }
}
