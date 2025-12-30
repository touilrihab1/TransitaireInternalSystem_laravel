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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id('id');
            $table->string('n_dossier')->nullable();
            //dossier prét ou en cours
            //dossier provisoir ou definitif
            //dossier import ou export
            $table->dateTime('date_arrive', 2)->nullable() ;
            $table->dateTime('date_dedouanement', 2)->nullable() ;
            $table->time('heure_sortie', 2)->nullable() ;
            $table->string('destination')->nullable() ;
            $table->date('date_dedouanement2')->nullable() ;
            $table->string('transporteur')->nullable() ;
            $table->string('n_manifeste')->nullable() ;
            $table->string('moyen_transport')->nullable() ;
            $table->string('connaissement')->nullable()  ;
            $table->string('n_moyen')->nullable()  ;//ouu n° bateau , n°rmoq
            $table->string('n_tc')->nullable()  ;
            //********************** */
            $table->double('poids_brut')->nullable() ;
            $table->double('poids_net')->nullable() ;
            $table->double('val_total_declare')->nullable() ;
            $table->integer('n_palette')->nullable() ;
            $table->integer('n_colis')->nullable() ;
            //*********************** */
            $table->string('designation_marchandise')->nullable() ;
            $table->string('expediteur')->nullable() ;
            $table->string('destinataire')->nullable();
            $table->string('client_facturation')->nullable() ;
            $table->string('centre_cout')->nullable();
            $table->string('contact_receptionnaire')->nullable() ;
            //******************************** */


            $table->string('demandeur')->nullable();
            $table->string('type_dossier')->nullable() ;
            $table->boolean('definitive')->nullable() ;
            $table->timestamps(2);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
