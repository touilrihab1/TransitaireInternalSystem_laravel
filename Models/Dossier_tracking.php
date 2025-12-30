<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_tracking extends Model
{
    use HasFactory;
    protected $table='dossier_tracking';
    protected $fillable =['id_dossier' ,'id_statut'];
}
