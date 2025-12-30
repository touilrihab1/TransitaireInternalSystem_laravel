<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeDossier extends Model
{
    use HasFactory;
    protected $table='charge_dossier';
    protected $primaryKey = 'id';
    protected $fillable =['id_dossier','id_charge','valeur','serie_facture'];
}
