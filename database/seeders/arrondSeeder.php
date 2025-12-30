<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use League\Csv\Reader;

class arrondSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/arrondissement.csv';
        $this->tablename = 'arrondissement';
        $this->delimiter = ';';
        $this->timestamps = false; // Disable timestamps

    }

    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // insert on id column
        // DB::unprepared('SET IDENTITY_INSERT '.$this->tablename.' ON');
        // disable foreign key error
        // DB::unprepared('ALTER TABLE '.$this->tablename.' NOCHECK CONSTRAINT ALL;');

        parent::run();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        // DB::unprepared('SET IDENTITY_INSERT '.$this->tablename.' OFF');
        // DB::unprepared('ALTER TABLE '.$this->tablename.' CHECK CONSTRAINT ALL;');

    }
}
