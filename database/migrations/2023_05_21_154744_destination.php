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
        Schema::create('destination', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_bureau');
            $table->string('code_stockage')->nullable();
            $table->string('intitule_designation')->nullable();



            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination');
    }
};
