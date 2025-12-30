<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['file_name', 'file_path', 'type'];

    public function fileType()
    {
        return $this->belongsTo(TypeFile::class, 'type');
    }
    public function dossier(){
        return  $this->belongsTo(Dossier::class, 'id_dossier');
    }
}
