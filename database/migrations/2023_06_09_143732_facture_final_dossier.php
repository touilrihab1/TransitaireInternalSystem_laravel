<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('factureFinal_dossier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dossier')->nullable() ;
            $table->unsignedBigInteger('id_client')->nullable() ;
            $table->string('num_facture')->nullable();
            $table->integer('valeur_net')->nullable() ;
            $table->string('etat')->nullable(); //payé /non payé
            //payé /non payé
            



            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factureFinal_dossier');
    }
};
