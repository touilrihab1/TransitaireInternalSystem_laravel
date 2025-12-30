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
        Schema::create('charge', function (Blueprint $table) {
            $table->id('Id_Charge');
            $table->string('Code_Charge')->nullable();
            $table->string('Designation_Charge')->nullable();



            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge');
    }
};
