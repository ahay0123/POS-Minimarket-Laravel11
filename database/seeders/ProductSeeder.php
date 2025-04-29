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
            'name_product' => 'Setrika Baju',
            'price' => '24000',
            'unit' => 'kg',
            'description' => 'Hanya setrika'
        ];

        DB::table('product')->insert($data);

        $data = [
            'name_product' => 'Setrika Baju',
            'price' => '24000',
            'unit' => 'kg',
            'description' => 'Hanya setrika'
        ];

        DB::table('product')->insert($data);


    }
}
