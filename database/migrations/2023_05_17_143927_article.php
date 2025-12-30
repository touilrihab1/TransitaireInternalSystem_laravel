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
        Schema::create('Article', function(Blueprint $table){
            $table->id('Id_Article');

            $table->unsignedBigInteger('Id_Nomenclature');
            $table->string('Code_Article')->nullable();
            $table->string('Designation_Article')->nullable();
            $table->string('Code_Nomencl')->nullable();
            $table->string('statut')->nullable();
            $table->string('idold')->nullable();
            $table->string('transfert')->nullable();
            $table->string('act')->nullable();
            $table->string('TYPE_ARTICLE')->nullable();
            $table->string('id_UniteMesure')->nullable();
                $table->timestamps(2);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Article');    }
};
