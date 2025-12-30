<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $primarykey = 'id';
 
    protected $fillable = [
        'num_facture',
        'date_facture',
        'destinataire',
        'code_destinataire',
        'adresse' ,
        'devise1',
        'cours1',
        'sigle',
        'incoterm',
        'mode_paie',
        'matricule',
        'poids_brut',
        'poids_net',
        'nbr_colid',
        'montant',
        'code_ngp',
        'code_article',
        'designation',
        
        'pays',
        'unite',
        'qte',
        'Poids_net_artcl',
        'val_devise'
   ];
}





      
        
        