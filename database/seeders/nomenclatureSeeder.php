<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class nomenclatureSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->tablename = 'Nomenclature';

    }

    public function run()
    {
        $path = database_path('seeds/Nomenclature.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Nomenclature' => $record['Id_Nomenclature'],
                'Code_Nomenclature' => $record['Code_Nomenclature'],
                'Intitule_Nomenclature' => $record['Intitule_Nomenclature'],
                'Id_Group_Tiers' => $record['Id_Group_Tiers'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
                'CodeNomenclature_regroupee' => $record['CodeNomenclature_regroupee'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT Nomenclature ON');
            }

            DB::table('Nomenclature')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT Nomenclature OFF');
            }
        }
    }
}
