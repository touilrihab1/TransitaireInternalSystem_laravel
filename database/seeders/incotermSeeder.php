<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class incotermSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeds/incoterm.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Incoterm' => $record['Id_Incoterm'],
                'Code_Incoterm' => $record['Code_Incoterm'],
                'Intitule_Incoterm' => $record['Intitule_Incoterm'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT incoterm ON');
            }

            DB::table('incoterm')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT incoterm OFF');
            }
        }
    }
}

