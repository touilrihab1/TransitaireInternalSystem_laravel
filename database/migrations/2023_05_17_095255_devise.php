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
        Schema::create('Devise', function(Blueprint $table){
            $table->id('Id_Devise');

            $table->string('Code_Devise')->nullable();
            $table->string('Cours')->nullable();
            $table->string('Sigle')->nullable();
            $table->string('Principal')->nullable();
            $table->string('Intitule_Devise')->nullable();
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
        Schema::dropIfExists('Devise');
    }
};
