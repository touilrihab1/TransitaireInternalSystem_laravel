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
        Schema::create('Nomenclature', function(Blueprint $table){
            $table->id('Id_Nomenclature');
            $table->string('Code_Nomenclature')->nullable();
            $table->string('Intitule_Nomenclature')->nullable();
            $table->string('Id_Group_Tiers')->nullable();
            $table->string('idold')->nullable();
            $table->string('transfert')->nullable();
            $table->string('act')->nullable();
            $table->string('CodeNomenclature_regroupee')->nullable();


                $table->timestamps(2);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Nomenclature');

    }
};
