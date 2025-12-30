<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class regimeSeeder extends Seeder
{
    public $tablename = 'regime';

    public function run()
    {
        $path = database_path('seeds/regime.csv');
        $delimiter = ';';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id_Regime' => $record['Id_Regime'],
                'Code_Regime' => $record['Code_Regime'],
                'Intitule_Regime' => $record['Intitule_Regime'],
                'Type_Regime' => $record['Type_Regime'],
                'idold' => $record['idold'],
                'transfert' => $record['transfert'],
                'act' => $record['act'],
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT ' . $this->tablename . ' ON');
            }

            DB::table($this->tablename)->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT ' . $this->tablename . ' OFF');
            }
        }
    }
}

