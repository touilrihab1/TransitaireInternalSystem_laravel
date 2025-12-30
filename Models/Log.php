<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class Log extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $fillable = [
        'id_dossier',
        'id_user',
        'tache'
    ];
    public $sortable = [
        'id_dossier',
        'id_user',
        'tache',
        'created_at'
    ];

}