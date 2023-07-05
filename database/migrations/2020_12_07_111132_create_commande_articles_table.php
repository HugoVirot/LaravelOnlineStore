<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_articles', function (Blueprint $table) {

            // primary key : porte sur la combinaison des 2 foreign keys (évite les doublons)
            $table->primary(['commande_id', 'article_id']);

            // les 2 foreign keys 
            $table->foreignId('commande_id')->constrained();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');

            // champs supplémentaires
            $table->integer('quantite');
            $table->integer('reduction')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_articles');
    }
}
