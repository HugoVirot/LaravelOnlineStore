<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function commandes(){
        return $this->belongsToMany(Commandes::class, 'commande_articles')->withPivot('quantite');;
    }

    public function campagnes(){
        return $this->belongsToMany(Campagne::class, 'campagne_articles');
    }

    //pour table intermédiaire favoris (users_articles)
    
    public function users(){           
        return $this->belongsToMany(User::class);
    }

    public function avis() 
    {
        return $this->hasMany(Avis::class);
    }

    public function gamme() 
    {
        return $this->belongsTo(Gamme::class);
    }  
}
