<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $primaryKey = 'Id';
    protected $fillable = [


        'Code_Tiers',
        'Raison_Sociale',
        'Contact',
        'Adresse',
        'Ville',
        'Code_Postale',
        'Pays',
        'NUM_EACCE1',
        'NUM_EACCE2',
        'NUM_EACCE3',
        'Code_Sage',
        'Num_RC',
        'Num_Centre',
        'Tel1',
        'Tel2',
        'Fax',
        'email'
    ];
    public function dums()
    {
        return $this->hasMany(Dossier::class);
    }
}
