<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incoterm extends Model
{
    use HasFactory;
    protected $table='incoterm';
    protected $primaryKey = 'Id_Incoterm';
    protected $fillable =['Code_Incoterm' ,'Intitule_Incoterm'];
}
