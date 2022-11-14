<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'Super Admin']);
        $role2 = Role::create(['name' => 'Pimpinan']);
        $role3 = Role::create(['name' => 'Admin']);
        $role4 = Role::create(['name' => 'Staff']);
        $role5 = Role::create(['name' => 'Asset Logistik']);
        $role6 = Role::create(['name' => 'Asset Umum']);

        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-export']);
        Permission::create(['name' => 'user-import']);
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);
        Permission::create(['name' => 'permission-list']);
        Permission::create(['name' => 'permission-create']);
        Permission::create(['name' => 'permission-edit']);
        Permission::create(['name' => 'permission-delete']);
        Permission::create(['name' => 'admin-list']);
        Permission::create(['name' => 'position-list']);
        Permission::create(['name' => 'position-create']);
        Permission::create(['name' => 'position-export']);
        Permission::create(['name' => 'position-import']);
        Permission::create(['name' => 'position-edit']);
        Permission::create(['name' => 'position-delete']);
        Permission::create(['name' => 'letter-list']);
        Permission::create(['name' => 'outgoing-letter-list']);
        Permission::create(['name' => 'outgoing-letter-create']);
        Permission::create(['name' => 'outgoing-letter-edit']);
        Permission::create(['name' => 'outgoing-letter-delete']);
        Permission::create(['name' => 'entry-letter-list']);
        Permission::create(['name' => 'entry-letter-create']);
        Permission::create(['name' => 'entry-letter-edit']);
        Permission::create(['name' => 'entry-letter-delete']);
        Permission::create(['name' => 'performance-report-list']);
        Permission::create(['name' => 'performance-report-create']);
        Permission::create(['name' => 'performance-report-edit']);
        Permission::create(['name' => 'performance-report-delete']);
        Permission::create(['name' => 'performance-report-archive']);
        Permission::create(['name' => 'activity-list']);
        Permission::create(['name' => 'activity-create']);
        Permission::create(['name' => 'activity-edit']);
        Permission::create(['name' => 'activity-delete']);
        Permission::create(['name' => 'additional-report-list']);
        Permission::create(['name' => 'additional-report-create']);
        Permission::create(['name' => 'additional-report-edit']);
        Permission::create(['name' => 'additional-report-delete']);
        Permission::create(['name' => 'asset-management']);
        Permission::create(['name' => 'asset-list']);
        Permission::create(['name' => 'asset-import']);
        Permission::create(['name' => 'asset-create']);
        Permission::create(['name' => 'asset-edit']);
        Permission::create(['name' => 'asset-delete']);
        Permission::create(['name' => 'supplier-list']);
        Permission::create(['name' => 'supplier-create']);
        Permission::create(['name' => 'supplier-edit']);
        Permission::create(['name' => 'supplier-delete']);
        Permission::create(['name' => 'location-list']);
        Permission::create(['name' => 'location-create']);
        Permission::create(['name' => 'location-edit']);
        Permission::create(['name' => 'location-delete']);
        Permission::create(['name' => 'logistic']);
        Permission::create(['name' => 'logistic-list']);
        Permission::create(['name' => 'logistic-create']);
        Permission::create(['name' => 'logistic-edit']);
        Permission::create(['name' => 'logistic-delete']);
        Permission::create(['name' => 'quote-list']);
        Permission::create(['name' => 'quote-create']);
        Permission::create(['name' => 'quote-edit']);
        Permission::create(['name' => 'quote-delete']);
        Permission::create(['name' => 'content-list']);
        Permission::create(['name' => 'content-create']);
        Permission::create(['name' => 'content-edit']);
        Permission::create(['name' => 'content-delete']);
        Permission::create(['name' => 'status-content']);
        Permission::create(['name' => 'sumber-list']);
        Permission::create(['name' => 'sumber-create']);
        Permission::create(['name' => 'sumber-edit']);
        Permission::create(['name' => 'sumber-delete']);
        Permission::create(['name' => 'golongan-list']);
        Permission::create(['name' => 'golongan-create']);
        Permission::create(['name' => 'golongan-edit']);
        Permission::create(['name' => 'golongan-delete']);
        Permission::create(['name' => 'tipeitem-list']);
        Permission::create(['name' => 'tipeitem-create']);
        Permission::create(['name' => 'tipeitem-edit']);
        Permission::create(['name' => 'tipeitem-delete']);
        Permission::create(['name' => 'kategoritem-list']);
        Permission::create(['name' => 'kategoritem-create']);
        Permission::create(['name' => 'kategoritem-edit']);
        Permission::create(['name' => 'kategoritem-delete']);
        Permission::create(['name' => 'detail-list']);
        Permission::create(['name' => 'detail-create']);
        Permission::create(['name' => 'detail-edit']);
        Permission::create(['name' => 'detail-delete']);
        Permission::create(['name' => 'pengadaan-list']);
        Permission::create(['name' => 'pengadaan-create']);
        Permission::create(['name' => 'pengadaan-edit']);
        Permission::create(['name' => 'pengadaan-delete']);
        Permission::create(['name' => 'brand-list']);
        Permission::create(['name' => 'brand-create']);
        Permission::create(['name' => 'brand-edit']);
        Permission::create(['name' => 'brand-delete']);
        Permission::create(['name' => 'asset']);


        $permissions = Permission::pluck('id', 'id')->all();

        $role1->syncPermissions($permissions);

        $role2->givePermissionTo('outgoing-letter-list');
        $role2->givePermissionTo('outgoing-letter-edit');
        $role2->givePermissionTo('entry-letter-list');
        $role2->givePermissionTo('entry-letter-create');
        $role2->givePermissionTo('entry-letter-edit');
        $role2->givePermissionTo('performance-report-list');
        $role2->givePermissionTo('performance-report-edit');
        $role2->givePermissionTo('performance-report-delete');
        $role2->givePermissionTo('performance-report-archive');

        $role2->givePermissionTo('activity-list');
        $role2->givePermissionTo('activity-create');
        $role2->givePermissionTo('activity-edit');
        $role2->givePermissionTo('activity-delete');
        $role2->givePermissionTo('additional-report-list');
        $role2->givePermissionTo('additional-report-create');
        $role2->givePermissionTo('additional-report-edit');
        $role2->givePermissionTo('additional-report-delete');

        $role3->givePermissionTo('outgoing-letter-list');
        $role3->givePermissionTo('outgoing-letter-edit');
        $role3->givePermissionTo('entry-letter-list');
        $role3->givePermissionTo('entry-letter-create');
        $role3->givePermissionTo('entry-letter-edit');
        $role3->givePermissionTo('entry-letter-delete');
        $role3->givePermissionTo('performance-report-list');
        $role3->givePermissionTo('performance-report-delete');
        $role3->givePermissionTo('performance-report-archive');

        $role4->givePermissionTo('outgoing-letter-list');
        $role4->givePermissionTo('outgoing-letter-create');
        $role4->givePermissionTo('outgoing-letter-edit');
        $role4->givePermissionTo('outgoing-letter-delete');
        $role4->givePermissionTo('performance-report-list');
        $role4->givePermissionTo('performance-report-create');
        $role4->givePermissionTo('performance-report-edit');
        $role4->givePermissionTo('performance-report-delete');
        $role4->givePermissionTo('activity-list');
        $role4->givePermissionTo('activity-create');
        $role4->givePermissionTo('activity-edit');
        $role4->givePermissionTo('activity-delete');
        $role4->givePermissionTo('additional-report-list');
        $role4->givePermissionTo('additional-report-create');
        $role4->givePermissionTo('additional-report-edit');
        $role4->givePermissionTo('additional-report-delete');

        // Role asset logistik
        $role5->givePermissionTo('logistic-list');
        $role5->givePermissionTo('logistic-create');
        $role5->givePermissionTo('logistic-edit');
        $role5->givePermissionTo('logistic-delete');

        // role asset umum
        $role5->givePermissionTo('asset-management');
        $role5->givePermissionTo('asset-import');
        $role5->givePermissionTo('asset-list');
        $role5->givePermissionTo('asset-create');
        $role5->givePermissionTo('asset-edit');
        $role5->givePermissionTo('asset-delete');
        $role5->givePermissionTo('logistic-list');
        $role5->givePermissionTo('logistic-create');
        $role5->givePermissionTo('logistic-edit');
        $role5->givePermissionTo('logistic-delete');
        $role5->givePermissionTo('supplier-list');
        $role5->givePermissionTo('supplier-create');
        $role5->givePermissionTo('supplier-edit');
        $role5->givePermissionTo('supplier-delete');
        $role5->givePermissionTo('location-list');
        $role5->givePermissionTo('location-create');
        $role5->givePermissionTo('location-edit');
        $role5->givePermissionTo('location-delete');
        $role5->givePermissionTo('sumber-list');
        $role5->givePermissionTo('sumber-create');
        $role5->givePermissionTo('sumber-edit');
        $role5->givePermissionTo('sumber-delete');
        $role5->givePermissionTo('golongan-list');
        $role5->givePermissionTo('golongan-create');
        $role5->givePermissionTo('golongan-edit');
        $role5->givePermissionTo('golongan-delete');
        $role5->givePermissionTo('tipeitem-list');
        $role5->givePermissionTo('tipeitem-create');
        $role5->givePermissionTo('tipeitem-edit');
        $role5->givePermissionTo('tipeitem-delete');
        $role5->givePermissionTo('kategoritem-list');
        $role5->givePermissionTo('kategoritem-create');
        $role5->givePermissionTo('kategoritem-edit');
        $role5->givePermissionTo('kategoritem-delete');
        $role5->givePermissionTo('detail-list');
        $role5->givePermissionTo('detail-create');
        $role5->givePermissionTo('detail-edit');
        $role5->givePermissionTo('detail-delete');
        $role5->givePermissionTo('brand-list');
        $role5->givePermissionTo('brand-create');
        $role5->givePermissionTo('brand-edit');
        $role5->givePermissionTo('brand-delete');
        $role5->givePermissionTo('asset');

        User::create([
            'name'      => 'Root',
            'nrp'       => '11111111111111',
            'username'  => 'superadmin',
            'email'     => 'root@uiii.ac.id',
            'status'    => true,
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Super Admin');

        User::create([
            'position_id'   => 1,
            'name'          => 'Prof. Dr. Komaruddin Hidayat',
            'nrp'           => '22222222222222',
            'username'      => 'rektor',
            'email'         => 'rektor@uiii.ac.id',
            'status'        => true,
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Pimpinan');

        // User::create([
        //     'position_id'   => 2,
        //     'name'          => 'Sekretaris Universitas',
        //     'nrp'           => '33333333333333',
        //     'username'      => 'sekretaris universitas',
        //     'email'         => 'sekretarisuniversitas@uiii.ac.id',
        //     'status'        => true,
        //     'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Admin');

        // User::create([
        //     'position_id'   => 3,
        //     'name'          => 'KTU Sekretaris',
        //     'nrp'           => '44444444444444',
        //     'username'      => 'ktusekretaris',
        //     'email'         => 'ktusekretaris@uiii.ac.id',
        //     'status'        => true,
        //     'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Pimpinan');

        // User::create([
        //     'position_id'   => 4,
        //     'name'          => 'Pelaksana Sekretariat',
        //     'nrp'           => '55555555555555',
        //     'username'      => 'pelaksanasekretaris',
        //     'email'         => 'pelaksanasekretaris@uiii.ac.id',
        //     'status'        => true,
        //     'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Admin');

        // User::create([
        //     'position_id'   => 5,
        //     'head_id'       => 4,
        //     'name'          => 'Staff',
        //     'nrp'           => '66666666666666',
        //     'username'      => 'staff',
        //     'email'         => 'staff@uiii.ac.id',
        //     'status'        => true,
        //     'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Staff');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
