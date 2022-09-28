<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            'nama' => 'admin'
        ]);

        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
        ]);
    }
}
