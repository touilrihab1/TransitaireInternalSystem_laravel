<?php

namespace App\Models;
use App\Models\Dossier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dum extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $fillable = [
            'num_dum',
          'num_sous_dum',
           'bureau_dedouanement',
            'bureau_destination',
           'arrondissement',
            'regime',
           'n_serie',
            'lettre',
           'repertoire',
            'date_debut',
            'date_fin',
            'declaration',
            'activite',
           'devise',
            'type_dum',//********* */
            'etat_dum'//********* */
    ];
    public function dossier()
    {
        return $this->hasMany(Dossier::class);
    }
}
