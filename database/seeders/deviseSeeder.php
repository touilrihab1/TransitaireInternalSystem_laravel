<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class deviseSeeder extends CsvSeeder
{
    public function __construct()
    {

        $this->tablename = 'Devise';

    }

    public function run()
    {
        $path = database_path('seeds/DEVISE.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            // Get the values from the CSV record
            $values = [
                'Id_Devise' => $record['Id_Devise'],
                'Code_Devise' => $record['Code_Devise'],
                'Cours' => $record['Cours'],
                'Sigle' => $record['Sigle'],
                'Principal' => $record['Principal'],
                'Intitule_Devise' => $record['Intitule_Devise'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
            ];

            if ($isSqlServer) {
                // Execute the statement only for SQL Server
                DB::unprepared('SET IDENTITY_INSERT ' . $this->tablename . ' ON');
            }

            // Insert the data into the database using query builder
            DB::table($this->tablename)->insert($values);

            if ($isSqlServer) {
                // Execute the statement only for SQL Server
                DB::unprepared('SET IDENTITY_INSERT ' . $this->tablename . ' OFF');
            }
        }
    }
}
