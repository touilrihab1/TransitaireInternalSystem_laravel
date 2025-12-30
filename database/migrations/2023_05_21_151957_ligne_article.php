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
        Schema::create('ligne_article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facture');
            $table->unsignedBigInteger('id_code_ngp');
            $table->unsignedBigInteger('id_code_article');
            $table->string('designation');
            $table->string('pays');
            $table->unsignedBigInteger('id_unite');
            $table->integer('qte');
            $table->integer('poids_net');
            $table->integer('valeur_devise');
            
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_article');
    }
};
