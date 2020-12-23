<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'nom' => 'TV Samsung F-225',
            'description' => '160cm de Diagonale et un contraste exceptionnel!',
            'description_detaillee' => 'Avec cette TV exceptionnelle, vivez plus intensément tous vos films et évènements sportifs. Son contraste de 10000:1 et sa large diagonale de 160cm vous assureront une expérience optimale !',
            'image' => 'tv.png',
            'gamme_id' => 2,
            'prix' => 999.95,
            'stock' => 50,
            'note' => 4.8,
        ]);

        Article::create([
            'nom' => 'Lecteur Blu-Ray LG HK8950',
            'description' => 'comme au cinéma !',
            'description_detaillee' => 'Une qualité d\'image parfaite et un prix agressif pour ce lecteur de dernière génération. Foncez !',
            'image' => 'blu-ray.jpg',
            'gamme_id' => 2,
            'prix' => 190.50,
            'stock' => 3,
            'note' => 4.4,
        ]);

        Article::create([
            'nom' => 'PC Portable Gamer MSI',
            'description' => 'Pour les winners !',
            'description_detaillee' => 'Ultra compétitif, il propose 32go de RAM et un SSD de 4 To. Spécialement designé pour les gamers avec son look moderne. Devenez imbattable dans tous vos jeux !',
            'image' => 'pc-gamer.jpg',
            'gamme_id' => 1,
            'prix' => 1499.90,
            'stock' => 17,
            'note' => 4.6,
        ]);

        Article::create([
            'nom' => 'Iphone 11',
            'description' => 'Le smartphone dernier cri !',
            'description_detaillee' => 'Un concentré de technologie entre vos mains ! Tout le savoir-faire d\'Apple est concentré dans ce bijou, doté d\'un appareil photo 64Mpx, de 256Go de stockage et d\'un lecteur d\'empreintes digitales. N\'hésitez plus !',
            'image' => 'iphone.jpg',
            'gamme_id' => 3,
            'prix' => 1099.49,
            'stock' => 0,
            'note' => 4.3,
        ]);

        Article::create([
            'nom' => 'Enceinte Sony BF122-12',
            'description' => 'Le gros son',
            'description_detaillee' => 'Suprenante et compacte, elle propose un rendu exceptionnel, d\'une grande finesse. Puissance de 50W : elle est prête pour toutes les occasions. Couleur bleu profond.',
            'image' => 'enceinte.jpg',
            'gamme_id' => 4,
            'prix' => 79.99,
            'stock' => 153,
            'note' => 3.9,
        ]);

        Article::create([
            'nom' => 'Montre connectée',
            'description' => 'De multiples fonctionnalités',
            'description_detaillee' => 'Elle propose, en plus de l\'heure et du chronométrage, toutes les applications Google, un relevé de la fréquence cardiaque, ainsi qu\'une fonction d\'appel. La référence qualité-prix.',
            'image' => 'montre.jpg',
            'gamme_id' => 5,
            'prix' => 189.95,
            'stock' => 92,
            'note' => 3.8,
        ]);

        Article::create([
            'nom' => 'Samsung Galaxy Fold',
            'description' => 'Révolutionnaire !',
            'description_detaillee' => 'Il peut se plier pour constituer un écran plus grand, au format tablette. Configuration musclée pour votre nouveau compagnon, avec entre autres 1Go de stockage.',
            'image' => 'fold.jpg',
            'gamme_id' => 3,
            'prix' => 899.99,
            'stock' => 7,
            'note' => 4.8,
        ]);
        
        Article::create([
            'nom' => 'PC portable Asus Vivobook',
            'description' => 'A toute épreuve',
            'description_detaillee' => 'Sa configuration musclée permet de gérer tous les usages : jeux vidéo, surf, bureautique. Design soigné et finition aluminium brossé. Processeur Intel Core i5 de dernière génération.',
            'image' => 'vivobook.jpg',
            'gamme_id' => 1,
            'prix' => 750.49,
            'stock' => 8,
            'note' => 4.0,
        ]);

        Article::create([
            'nom' => 'Chaîne hi-fi Phillips MZ-447',
            'description' => 'Elegante et moderne',
            'description_detaillee' => 'Un rendu sonore exceptionnel grâce à la technologie Dolby Surround Theater. Très complète : 2 x 60W / Bluetooth / USB / Télécommande',
            'image' => 'chaine.jpg',
            'gamme_id' => 4,
            'prix' => 119.99,
            'stock' => 67,
            'note' => 3.9,
        ]);

        Article::create([
            'nom' => 'Kit surveillance OTIO',
            'description' => 'Sécurisez votre maison',
            'description_detaillee' => 'Partez tranquille avec le kit de surveillance conecté OTIO. Surveillez votre domicile depuis votre smartphone avec l\'application OTIOWatch. Simple et efficace !',
            'image' => 'kit-surveillance.jpg',
            'gamme_id' => 5,
            'prix' => 99.99,
            'stock' => 123,
            'note' => 4.1,
        ]);

        for ($i = 0; $i < 30; $i++) {
            DB::table('articles')->insert([
                'nom' => 'Produit ' . ($i+1),
                'description' => Str::random(50),
                'description_detaillee' => Str::random(100),
                'image' => 'logo.png',
                'gamme_id' => rand(1,4),
                'prix' => mt_rand(5, 1000),
                'stock' => 50,
                'note' => 4.5,
            ]);
        }
    }
}
