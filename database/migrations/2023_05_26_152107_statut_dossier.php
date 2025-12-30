<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Psy\Shell;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statut_dossier', function (Blueprint $table) {
            $table->id('Id_Sous_Statut');
            $table->string('Libelle_Sous_Statut') ;
            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('statut_dossier') ;
    }
};
