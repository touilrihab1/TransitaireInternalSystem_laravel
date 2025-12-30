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
      
        Schema::create('dums', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_client');
            $table->string('num_dum')->nullable();
           // $table->string('num_dum', 40)->nullable(); // 401 023 2023 001234 H
            $table->string('num_sous_dum', 400)->nullable();
            $table->string('bureau_dedouanement', 200)->nullable();
            $table->string('bureau_destination', 200)->nullable();
            $table->string('arrondissement', 200)->nullable();
            $table->string('regime',222)->nullable();
            $table->string('n_serie', 60)->nullable();
            $table->string('lettre', 1)->nullable();
            $table->integer('repertoire')->nullable();
            $table->dateTime('date_debut', 2)->nullable();
            $table->dateTime('date_fin', 2)->nullable();
            $table->string('declaration')->nullable(); // Définitive - Provisionnelle
            $table->string('activite',222)->nullable(); // Industrielle - Perissable ???
            $table->string('devise');
            $table->string('type_dum')->nullable(); // Exportation - Importation
            $table->integer('etat_dum')->nullable();
            $table->timestamps(2);


          //  $table->foreign('user_id')->references('id')->on('users');
           // $table->unsignedBigInteger('client_id');
            // $table->foreign('client_id')->references('id')->on('clients');


            // $table->unsignedBigInteger('devise_id');
            // $table->foreign('devise_id')->references('id')->on('devises');

        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dums');
    }
};
