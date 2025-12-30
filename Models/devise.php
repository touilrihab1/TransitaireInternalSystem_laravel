<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devise extends Model
{
    use HasFactory;
    protected $table='devise';
    protected $primaryKey = 'Id_Devise';
    protected $fillable =['Code_Devise' ,'Cours','Intitule_Devise'];
}
