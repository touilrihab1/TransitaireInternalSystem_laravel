<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charge extends Model
{
    use HasFactory;
    protected $table='charge';
    protected $primaryKey = 'Id_Charge';
    protected $fillable =['Code_Charge','Designation_Charge'];
}
