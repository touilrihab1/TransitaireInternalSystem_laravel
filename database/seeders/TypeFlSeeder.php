<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeFile ;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;



class TypeFlSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/Document.csv';
        $this->tablename = 'type_file';
        $this->delimiter = ';';
        $this->timestamps = false; // Disable timestamps
    }

    public function run()
    {
        $path = database_path('seeds/Document.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'id' => $record['id'],
                'type' => $record['type'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT type_file ON');
            }

            DB::table('type_file')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT type_file OFF');
            }
        }
    }
}



