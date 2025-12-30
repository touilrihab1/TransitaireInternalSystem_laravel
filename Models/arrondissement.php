<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class arrondissement extends Model
{
    use HasFactory;
    use Sortable ;
    protected $primaryKey = 'id';
    protected $table = "arrondissement";
    public $sortable = ['code_b', 'intitule_b','code_a', 'intitule_a'];
    protected $fillable = ['code_b',  'intitule_b' ,'code_a', 'intitule_a'];

    public $timestamps = false;
}
