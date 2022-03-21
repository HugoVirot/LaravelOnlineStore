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
            $table->foreignId('commande_id')->constrained();

            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('set null');

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
