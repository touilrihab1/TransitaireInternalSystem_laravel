<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class UnitySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/unite_mesure.csv';
        $this->tablename = 'unite_mesure';
        $this->delimiter = ';';
        $this->timestamps = false; // Disable timestamps
    }

    public function run()
    {
        $path = database_path('seeds/unite_mesure.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Unite_Mesure' => $record['Id_Unite_Mesure'],
                'Code_Unite' => $record['Code_Unite'],
                'Intitule_Unite' => $record['Intitule_Unite'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT unite_mesure ON');
            }

            DB::table('unite_mesure')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT unite_mesure OFF');
            }
        }
    }
}
