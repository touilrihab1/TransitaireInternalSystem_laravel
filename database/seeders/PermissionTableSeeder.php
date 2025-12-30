<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'creer dossier',
            'voir dossier',
            'annexer document',
            'export list dossier excel',
            'modifier dossier',
             'modifier poids brut',
             'client',
             'taux de change',
             'ventiler',
             'ajouter ligne article',
             'creer DUM',
             'creer Facture final',
             'creer Facture mensuelle',
             'ajouter les charges'
           
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
