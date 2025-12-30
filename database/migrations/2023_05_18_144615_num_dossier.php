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
        Schema::create('num_dossiers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('import');
            $table->bigInteger('export');
        });
        DB::table('num_dossiers')->insert([
            'import' => 1,
            'export' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('num_dossiers');
    }
};
