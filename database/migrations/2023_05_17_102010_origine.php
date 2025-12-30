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
        Schema::create('origine', function (Blueprint $table) {
            $table->id('Id_Origine');

            $table->string('Code_Origine')->nullable();
            $table->string('Intitule_Origine')->nullable();
            $table->string('Iso')->nullable();
            $table->string('idold')->nullable();
            $table->string('transfert')->nullable();
            $table->string('act')->nullable();
            $table->string('TypePays')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('origine');
    }
};
