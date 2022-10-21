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

        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);
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
        Permission::create(['name' => 'asset-list']);
        Permission::create(['name' => 'asset-create']);
        Permission::create(['name' => 'asset-edit']);
        Permission::create(['name' => 'asset-delete']);

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
