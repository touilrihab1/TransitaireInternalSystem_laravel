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
        Schema::create('arrondissement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_b');
            $table->string('intitule_b');
            $table->integer('code_a');
            $table->string('intitule_a');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrondissement');
    }
};
