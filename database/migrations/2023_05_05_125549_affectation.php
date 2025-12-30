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
        Schema::create('affectation', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role')->nullable();
            $table->unsignedBigInteger('id_dossier')->nullable();
            $table->string('observation',255)->nullable();
            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectation');
    }
};
