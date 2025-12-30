<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Article extends Model
{
    use HasFactory;
    use Sortable ;
    protected $table='article';
    protected $sortable =['Code_Article','Designation_Article','Code_Nomencl'];
    protected $primaryKey = 'Id_Article';
    protected $fillable =['Code_Article','Designation_Article','Code_Nomencl'];
    
}
