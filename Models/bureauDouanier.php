<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\arrondissement;
use Kyslik\ColumnSortable\Sortable;

class bureauDouanier extends Model
{
    use HasFactory;
    use Sortable;
    protected $primaryKey = 'code';
    public $sortable = ['code', 'bureau_d'];
    protected $table = "bureau_douanier";
    protected $fillable = ['code', 'bureau_d'];

    public function arrandissements()
    {
        return $this->hasMany(arrondissement::class, 'code_bureau', 'id');
    }

    public function getFullnameAttribute()
    {
        return "{$this->code} - {$this->bureau_d}";
    }
}