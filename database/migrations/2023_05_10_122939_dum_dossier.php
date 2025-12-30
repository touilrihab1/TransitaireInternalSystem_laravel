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
        Schema::create('dum_dossier', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dum')->nullable();
            $table->unsignedBigInteger('id_dossier')->nullable();

            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dum_dossier');
    }
};
