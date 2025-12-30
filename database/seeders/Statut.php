<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class Statut extends CsvSeeder

{ public function __construct()
    {
        $this->file = '/database/seeds/sous_statut.csv';
        $this->tablename = 'statut_dossier';
        $this->delimiter = ';';
        $this->timestamps = false; // Disable timestamps
    }

    public function run()
    {
        $path = database_path('seeds/sous_statut.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Sous_Statut' => $record['Id_Sous_Statut'],
                'Libelle_Sous_Statut' => $record['Libelle_Sous_Statut'],
                
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT statut_dossier ON');
            }

            DB::table('statut_dossier')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT statut_dossier OFF');
            }
        }
    }
}
