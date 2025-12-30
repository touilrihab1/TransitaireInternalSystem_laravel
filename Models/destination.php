<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destination extends Model
{
    use HasFactory;
    protected $table='destination';
    protected $fillable =['code_bureau' ,'code_stockage','intitule_designation'];
}
