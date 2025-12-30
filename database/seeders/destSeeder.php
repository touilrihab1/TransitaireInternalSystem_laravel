<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class destSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeds/destination.csv');
        $delimiter = ',';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'code_bureau' => $record['code_bureau'],
                'code_stockage' => $record['code_stockage'],
                'intitule_designation' => $record['intitule_designation'],
            ];

            if ($isSqlServer) {
                // DB::unprepared('SET IDENTITY_INSERT destination ON');
                DB::unprepared('ALTER TABLE destination NOCHECK CONSTRAINT ALL;');
            }

            // Exclude the identity column from the insert statement
            DB::table('destination')->insert($values);

            if ($isSqlServer) {
                // DB::unprepared('SET IDENTITY_INSERT destination OFF');
                DB::unprepared('ALTER TABLE destination CHECK CONSTRAINT ALL;');
            }
        }
    }
}
