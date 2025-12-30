<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class bureauSeeder extends CsvSeeder
{
    public function run()
    {
        $path = database_path('seeds/bureau_douanier.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'code' => $record['code'],
                'bureau_d' => $record['bureau_d'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT bureau_douanier ON');
            }

            DB::table('bureau_douanier')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT bureau_douanier OFF');
            }
        }
    }
}

