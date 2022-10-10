<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Position::truncate();
        Position::create(['name' => 'Rektor']);
        Position::create(['name' => 'Sekretaris Universitas']);
        Position::create(['name' => 'KTU Sekretaris']);
        Position::create(['name' => 'Pelaksana Sekretariat']);
        Position::create(['name' => 'Unit Pengusul']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
