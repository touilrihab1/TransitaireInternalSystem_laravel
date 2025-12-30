<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        Schema::table("dums", function (Blueprint $table) {

            $table->foreign('id_client')->references('Id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('files', function (Blueprint $table) {

            $table->foreign('id_dossier')
                ->references('id')
                ->on('dossiers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('affectation', function (Blueprint $table) {

            $table->foreign('id_dossier')
                ->references('id')
                ->on('dossiers');
            $table->foreign('id_role')
                ->references('id')
                ->on('roles');
        });
        // Schema::table('logs', function (Blueprint $table) {

        //     $table->foreign('id_dossier')
        //           ->references('id')
        //           ->on('dossiers');
        //     $table->foreign('id_user')
        //           ->references('id')
        //            ->on('users');
        //         });
        // Schema::table('arrondissement', function (Blueprint $table) {


        //     $table->foreign('code')
        //           ->references('code')
        //           ->on('bureau_douanier')
        //           ->onDelete('cascade')
        //           ->onUpdate('cascade');

        // });
        Schema::table('dum_dossier', function (Blueprint $table) {

            $table->foreign('id_dossier')
                ->references('id')
                ->on('dossiers');
            $table->foreign('id_dum')
                ->references('id')
                ->on('dums');

        });
        Schema::table('arrondissement', function (Blueprint $table) {

            $table->foreign('code_b')->
                references('code')->on('bureau_douanier')->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('destination', function (Blueprint $table) {

            $table->foreign('code_bureau')->
                references('code')->on('bureau_douanier')->onDelete('cascade')
                ->onUpdate('cascade');
        });
        //----------------------------------------------//
        Schema::table('files', function (Blueprint $table) {

            $table->foreign('type')->
                references('id')->on('type_file');
        });

        //---------------------------------------------//
        Schema::table('ligne_article', function (Blueprint $table) {

            $table->foreign('id_code_ngp')->
                references('Id_Nomenclature')->on('Nomenclature');
        });

        Schema::table('ligne_article', function (Blueprint $table) {

            $table->foreign('id_unite')->
                references('Id_Unite_Mesure')->on('Unite_mesure');
        });

        Schema::table('ligne_article', function (Blueprint $table) {
            $table->foreign('id_code_article')->
                references('Id_Article')->on('Article')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });


        Schema::table('Article', function (Blueprint $table) {

            $table->foreign('Id_Nomenclature')->
                references('Id_Nomenclature')->on('Nomenclature')->onDelete('cascade')
                ->onUpdate('cascade');

        });



        Schema::table('facture_dossier', function (Blueprint $table) {
            $table->foreign('id_facture')->references('id')->on('factures')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_dossier')->references('id')->on('dossiers')->onDelete('cascade')
                ->onUpdate('cascade');
        });


        Schema::table('ligne_article', function (Blueprint $table) {
            $table->foreign('id_facture')->
                references('id')->on('factures')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
        Schema::table('ventillations_dossier', function (Blueprint $table) {
            $table->foreign('id_dossier')->
                references('id')->on('dossiers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::table('dossier_tracking', function (Blueprint $table) {
            $table->foreign('id_dossier')->
                references('id')->on('dossiers')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_statut')->
                references('Id_Sous_Statut')->on('statut_dossier')->onDelete('cascade')
                ->onUpdate('cascade');

        });
//---------------------------clients---------------------------
        Schema::table('user_client', function (Blueprint $table) {
            $table->foreign('id_user')->
                references('id')->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_client')->
                references('id')->on('clients')->onDelete('cascade')
                ->onUpdate('cascade');

        });
//************************************************************* */
        //                  Schema::table('facture_dossier', function (Blueprint $table) {
//                     $table->foreign('id_facture')->references('id')->on('factures');
//                     $table->foreign('id_dossier')->references('id')->on('dossiers');
//                 });
                         Schema::table('charge_dossier', function (Blueprint $table) {
                        $table->foreign('id_charge')->references('Id_Charge')->on('charge');
                        $table->foreign('id_dossier')->references('id')->on('dossiers');
                    });

                         Schema::table('factureFinal_dossier', function (Blueprint $table) {
                        $table->foreign('id_client')->references('Id')->on('clients');
                        $table->foreign('id_dossier')->references('id')->on('dossiers');
                    });
                         Schema::table('factureFinal_mensuelle', function (Blueprint $table) {
                        $table->foreign('id_client')->references('Id')->on('clients');
                        $table->foreign('id_dossier')->references('id')->on('dossiers');
                    });





    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};