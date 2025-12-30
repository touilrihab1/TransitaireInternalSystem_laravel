<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;


class ChargeSeeder extends CsvSeeder
{
    public function run()
    {
        $path = database_path('seeds/Charge.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Charge' => $record['Id_Charge'],
                'Code_Charge' => $record['Code_Charge'],
                'Designation_Charge' => $record['Designation_Charge'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT charge ON');
            }

            DB::table('charge')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT charge OFF');
            }
        }
    }
}
