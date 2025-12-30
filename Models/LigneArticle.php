<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneArticle extends Model
{
    use HasFactory;
    protected $table = 'articles_fac';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_Nomenclature',
        'Origine',
        'Unite_Mesure',
        'Valeur_devise',
        'code_article',
        'designation',
        'Qte',
        'poids_net',
    ];
    public function unite_mesure()
    {
        return $this->belongsTo(unityMesure::class, 'Unite_Mesure', 'Code_Unite');
    }
}
