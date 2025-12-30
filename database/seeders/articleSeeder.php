<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class articleSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeds/Article.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Article' => $record['Id_Article'],
                'Id_Nomenclature' => $record['Id_Nomenclature'],
                'Code_Article' => $record['Code_Article'],
                'Designation_Article' => $record['Designation_Article'],
                'Code_Nomencl' => $record['Code_Nomencl'],
                'statut' => $record['statut'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
                'TYPE_ARTICLE' => $record['TYPE_ARTICLE'],
                'id_UniteMesure' => $record['id_UniteMesure'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT Article ON');
                DB::unprepared('ALTER TABLE Article  NOCHECK CONSTRAINT ALL;');
            }else{
                DB::statement('SET FOREIGN_KEY_CHECKS=0');

            }

            DB::table('Article')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT Article OFF');
                DB::unprepared('ALTER TABLE Article CHECK CONSTRAINT ALL;');

            }
            else{
                DB::statement('SET FOREIGN_KEY_CHECKS=1');

            }
        }
    }
}
