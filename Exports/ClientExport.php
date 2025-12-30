<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Client::all();
        // return Client::select('id','code_sage','raison_sociale','adresse', 'ville','tel1','email')->get();
        $clients = Client::select('id','code_sage','raison_sociale','adresse', 'ville','tel1','email')->get();

        // Add headings to the collection
        $headings = [
            'Client ID',
            'Sage Code',
            'Client Name',
            'Address',
            'City',
            'Phone',
            'Email',
        ];

        $collection = collect([$headings]);

        foreach ($clients as $client) {
            $collection->push([
                $client->id,
                $client->code_sage,
                $client->raison_sociale,
                $client->adresse,
                $client->ville,
                $client->tel1,
                $client->email,
            ]);
        }

        return $collection;

    }
}
