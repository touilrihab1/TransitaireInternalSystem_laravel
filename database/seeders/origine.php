<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class origine extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/pays.csv';
        $this->tablename = 'origine';
        $this->delimiter = ';';
        $this->timestamps = false; // Disable timestamps
    }

    public function run()
    {
        $path = database_path('seeds/pays.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Origine' => $record['Id_Origine'],
                'Code_Origine' => $record['Code_Origine'],
                'Intitule_Origine' => $record['Intitule_Origine'],
                'Iso' => $record['Iso'],
                'TypePays' => $record['TypePays'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT '.$this->tablename.' ON');
            }

            DB::table($this->tablename)->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT '.$this->tablename.' OFF');
            }
        }
    }
}

