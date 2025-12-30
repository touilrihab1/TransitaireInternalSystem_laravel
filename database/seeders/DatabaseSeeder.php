<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(bureauSeeder::class);
        $this->call(arrondSeeder::class);
        $this->call(regimeSeeder::class);


        $this->call(nomenclatureSeeder::class);
        $this->call(incotermSeeder::class);

        $this->call(UnitySeeder::class);
        $this->call(TypeFlSeeder::class);
        $this->call(deviseSeeder::class);
        $this->call(origine::class);
        $this->call(clientsSeeder::class);

        $this->call(Statut::class) ;
        $this->call(articleSeeder::class);
        $this->call(destSeeder::class);
        $this->call(ChargeSeeder::class);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
