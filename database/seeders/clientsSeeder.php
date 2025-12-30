<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;



class clientsSeeder extends CsvSeeder
{
    public function __construct()
    {

        $this->tablename = 'clients';

    }

    public function run()
    {
        $path = database_path('seeds/clients.csv');
        $delimiter = ',';

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset(0); // Specify if the CSV file has a header row

        $records = $csv->getRecords(); // Returns an iterator of CSV records

        $connectionName = config('database.default');
        $isSqlServer = config("database.connections.$connectionName.driver") === 'sqlsrv';

        foreach ($records as $record) {
            $values = [
                'Id' => isset($record['Id']) ? $record['Id'] : null,
                'Code_Tiers' => $record['Code_Tiers'],
                'Raison_Sociale' => $record['Raison_Sociale'],
                'Contact' => $record['Contact'],
                'Adresse' => $record['Adresse'],
                'Ville' => $record['Ville'],
                'Code_Postale' => $record['Code_Postale'],
                'Pays' => $record['Pays'],
                'NUM_EACCE1' => $record['NUM_EACCE1'],
                'NUM_EACCE2' => $record['NUM_EACCE2'],
                'NUM_EACCE3' => $record['NUM_EACCE3'],
                'Num_RC' => $record['Num_RC'],
                'Num_Centre' => $record['Num_Centre'],
                'Tel1' => $record['Tel1'],
                'Tel2' => $record['Tel2'],
                'Fax' => $record['Fax'],
                'email' => isset($record['email']) ? $record['email'] : null,
            ];

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT clients ON');
            }

            DB::table('clients')->insert($values);

            if ($isSqlServer) {
                DB::unprepared('SET IDENTITY_INSERT clients OFF');
            }
        }
    }
}

