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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Code_Tiers')->nullable(); // genération automatique

            $table->string('Raison_Sociale')->nullable();
            $table->string('Contact')->nullable();
            //cordonné
            $table->string('Adresse',)->nullable();
            $table->string('Ville',)->nullable();
            $table->string('Code_Postale',)->nullable();
            $table->string('Pays',)->nullable();

            $table->string('NUM_EACCE1')->nullable();
            $table->string('NUM_EACCE2')->nullable();
            $table->string('NUM_EACCE3')->nullable();
            $table->string('periode_paiement')->nullable();
           
            $table->string('Num_RC')->nullable();
            $table->string('ice')->nullable();
            $table->string('Num_Centre')->nullable();
            //telécomunication
            $table->string('Tel1',)->nullable();
            $table->string('Tel2',)->nullable();
            $table->string('Fax',)->nullable();
            $table->string('email')->nullable();


            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
