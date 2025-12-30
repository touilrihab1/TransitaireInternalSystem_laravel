<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;


use Kyslik\ColumnSortable\Sortable;

class Dossier extends Model
{
    use HasFactory;
    use Sortable;

    protected $primaryKey = 'id';
    public $sortable = ['poids_net', 'poids_brut', 'date_arrive', 'n_colis', 'created_at'];
    protected $fillable = [
        'date_arrive',
        'date_dedouanement',
        'heure_sortie',
        'destination',
        'date_dedouanement2',
        'transporteur',
        'n_manifeste',
        'moyen_transport',
        'connaissement',
        'n_moyen',
        'n_tc',
        'poids_brut',
        'poids_net',
        'val_total_declare',
        'n_palette',
        'n_colis',
        'designation_marchandise',
        'expediteur',
        'client_facturation',
        'demandeur',
        'contact_receptionnaire',
        'type_dossier',
        'created_at'
    ];

    public function files()
    {
        return $this->hasMany(File::class, 'id_dossier', 'id');
    }
    public function affectation()
    {
        return $this->hasMany(Affectation::class, 'id_dossier', 'id');
    }
}