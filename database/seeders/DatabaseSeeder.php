<?php

namespace Database\Seeders;

use App\Models\brandItem;
use App\Models\golongan;
use App\Models\kelompokBarang;
use App\Models\lokasi;
use App\Models\sumber;
use App\Models\supplier;
use App\Models\tipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PositionSeeder::class,
            UserSeeder::class,
        ]);

        //     lokasi::create([
        //         'lokasi' => 'Rektorat',
        //         'kode_lokasi' => '01'
        //     ]);

        //     lokasi::create([
        //         'lokasi' => 'Masjid',
        //         'kode_lokasi' => '02'
        //     ]);

        //     lokasi::create([
        //         'lokasi' => 'Perpustakaan',
        //         'kode_lokasi' => '03'
        //     ]);

        //     sumber::create(['sumber' => 'BPPTNBH', 'kode_sumber' => '1']);
        //     sumber::create(['sumber' => 'Hibah', 'kode_sumber' => '2']);
        //     sumber::create(['sumber' => 'Perolehan Sendiri', 'kode_sumber' => '3']);
        //     golongan::create(['nama_golongan' => 'Tidak Bergerak', 'kode_golongan' => '1']);
        //     golongan::create(['nama_golongan' => 'Bergerak', 'kode_golongan' => '2']);
        //     golongan::create(['nama_golongan' => 'Tidak Berwujud', 'kode_golongan' => '3']);
        //     tipe::create(['nama_tipe' => 'Meublair', 'kode_tipe' => '02']);
        //     tipe::create(['nama_tipe' => 'Alat Kantor', 'kode_tipe' => '03']);
        //     tipe::create(['nama_tipe' => 'Alat Media', 'kode_tipe' => '04']);
        //     kelompokBarang::create(['nama_kelompok' => 'Gedung Rektorat', 'kode_kelompok' => '001']);
        //     kelompokBarang::create(['nama_kelompok' => 'Gedung Masjid', 'kode_kelompok' => '002']);
        //     kelompokBarang::create(['nama_kelompok' => 'Gedung Perpustakaan', 'kode_kelompok' => '003']);

        //     supplier::create([
        //         'nama_pemasok' => 'CV. Ungu Ikrar Nusantara',
        //         'kode_pemasok' => '0001'
        //     ]);

        //     supplier::create([
        //         'nama_pemasok' => 'CV. Jaya Mukti',
        //         'kode_pemasok' => '0013'
        //     ]);

        //     brandItem::create([
        //         'nama_brand' => 'Extron',
        //         'kode_brand' => '0016'
        //     ]);

        //     brandItem::create([
        //         'nama_brand' => 'Vivente',
        //         'kode_brand' => '0010'
        //     ]);

        //     brandItem::create([
        //         'nama_brand' => 'Yamaha',
        //         'kode_brand' => '0015'
        //     ]);
    }
}
