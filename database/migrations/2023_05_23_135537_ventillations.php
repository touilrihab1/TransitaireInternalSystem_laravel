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
    Schema::create('ventillations', function (Blueprint $table) {
        $table->id() ;
        $table->unsignedBigInteger('id_facture') ;
        $table->bigInteger('code_nomenclature');
        $table->bigInteger('code_article');
        $table->string('origin') ;
        $table->string('unite_mesure');
        $table->bigInteger('qte_total');
        $table->bigInteger('poids_net_total');
        $table->bigInteger('valeur_devise_total');
        $table->string('code_devise')->nullable();
        $table->integer('cours_devise')->nullable();
        $table->integer('contre_valeur_DH')->nullable() ;
            $table->timestamps();
    });
}

  public function down(): void
{
    Schema::dropIfExists('ventillations');
}  
  
};
