<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Seeder
        $user = User::create([
            'name' => 'LaravelTuts',
            'email' => 'admin@puertotransit.com',
            'password' => bcrypt('password'),
            'isclient' => 0
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        //exploitation
        $user1 = User::create([
            'name' => 'exploitation1',
            'email' => 'exploitation@xx.com',
            'password' => bcrypt('xxx'),
            'isclient' => 0
        ]);

        $role1 = Role::create(['name' => 'exploitation']);

        $permissions1 = Permission::pluck('id', 'id')->all();

        $role1->syncPermissions($permissions1);

        $user1->assignRole([$role1->id]);

        //dédouanement
        $user2 = User::create([
            'name' => 'dédouanement1',
            'email' => 'dedouanement@xx.com',
            'password' => bcrypt('xxx'),
            'isclient' => 0
        ]);
        $role2 = Role::create(['name' => 'dédouanement']);
        $permissions2 = Permission::pluck('id', 'id')->all();

        $role2->syncPermissions($permissions2);
        $user2->assignRole([$role2->id]);

        $role3 = Role::create(['name' => 'client']);
        $user3 = User::create([
            'name' => 'client1',
            'email' => 'client@xx.com',
            'password' => bcrypt('xxx'),
            'isclient' => 1
        ]);
        $user3->assignRole([$role3->id]);

        $role4 = Role::create(['name' => 'facturation']);
        $user4 = User::create([
            'name' => 'facturation1',
            'email' => 'facturation@xx.com',
            'password' => bcrypt('xxx'),
            'isclient' => 0
        ]);
        $user4->assignRole([$role4->id]);
    }
}