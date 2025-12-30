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
        Schema::create('factures', function (Blueprint $table) {
            $table->id() ;
            $table->string('num_facture')->nullable();
            $table->date('date_facture')->nullable();
            $table->string('destinataire')->nullable();
            $table->string('code_destinataire')->nullable();
            $table->string('adresse')->nullable();
            $table->string('devise1')->nullable();
            $table->string('cours1')->nullable();
            $table->string('sigle')->nullable();
            $table->string('incoterm')->nullable();
            $table->string('mode_paie')->nullable();
            $table->integer('poids_net')->nullable();
            $table->integer('poids_brut')->nullable();
            $table->string('matricule')->nullable();
            $table->string('nbr_colid')->nullable();
            $table->string('montant')->nullable();
            //************************************* */
            $table->string('code_ngp')->nullable();
            $table->string('code_article')->nullable();
            $table->string('designation')->nullable();
            $table->string('pays')->nullable();
            $table->string('unite')->nullable();
            $table->integer('qte')->nullable();
            $table->integer('Poids_net_artcl')->nullable();
            $table->integer('val_devise')->nullable();
            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
