<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->float('prix');
            $table->timestamps();

            // foreign key user_id : pointe vers le champ id de la table users
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // foreign key adresse_livraison_id : pointe vers le champ id de la table adresses
            $table->unsignedBigInteger('adresse_livraison_id')->nullable();
            $table->foreign('adresse_livraison_id')->references('id')->on('adresses')->onDelete('set null');

            // foreign key adresse_livraison_id : pointe vers le champ id de la table adresses
            $table->unsignedBigInteger('adresse_facturation_id')->nullable();
            $table->foreign('adresse_facturation_id')->references('id')->on('adresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
