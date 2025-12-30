<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureFinal_mensuelle extends Model
{
    use HasFactory;
    protected $table='facturefinal_mensuelle';
    protected $primaryKey = 'id';
    protected $fillable =['id_dossier' ,'id_client','num_facture' ,'valeur_net','etat'];
}
