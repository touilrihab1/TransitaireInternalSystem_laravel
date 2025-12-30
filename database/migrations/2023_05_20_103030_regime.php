<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('regime', function (Blueprint $table) {
            $table->id('Id_Regime');
            $table->string('Code_Regime')->nullable();
            $table->string('Intitule_Regime')->nullable();
            $table->string('Type_Regime')->nullable();
            $table->string('idold')->nullable();
            $table->string('transfert')->nullable();
            $table->string('act')->nullable();


            $table->timestamps(2);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regime');
    }
};
