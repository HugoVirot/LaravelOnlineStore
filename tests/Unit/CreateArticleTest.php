<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class CreateArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;  // remet la bdd à son état initial après un test

    /** @test */
    public function testArticleCreation()
    {

        // on vérifie que l'on part d'une table articles vide
        $this->assertEquals(0, Article::count());


        // on crée une gamme qui va être associée à l'article
        DB::table('gammes')->insert([
            'nom' => 'ma super gamme',
        ]);

        // on initialise les données
        $data = [
            'nom' => 'article 1',
            'description' => 'super article',
            'description_detaillee' => 'Article exceptionnel, unique, incroyable, extraordinaire !',
            'image' => 'article.jpg',
            'prix' => 99.99,
            'stock' => 10,
            'note' => 4,
            'gamme_id' => 1
        ];

        // on sauvegarde l'article en bdd
        $this->json('POST', 'articles', $data);

        // on vérifie que la table articles contient bien notre nouvel article
        $this->assertEquals(1, Article::count());

        // on récupère le nouvel article dans la base
        $article = Article::first();

        // on vérifie qu'il correspond à nos données insérées
        $this->assertEquals($data['nom'], $article->nom);
        $this->assertEquals($data['description'], $article->description);
        $this->assertEquals($data['description_detaillee'], $article->description_detaillee);
        $this->assertEquals($data['image'], $article->image);
        $this->assertEquals($data['prix'], $article->prix);
        $this->assertEquals($data['stock'], $article->stock);
        $this->assertEquals($data['note'], $article->note);
        $this->assertEquals($data['gamme_id'], $article->gamme_id);
    }
}
