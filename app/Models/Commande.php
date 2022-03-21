<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class, 'commande_articles')->withPivot('quantite', 'reduction');
    }

    public function adresseLivraison() {
        return $this->belongsTo(Adresse::class);
    }

    public function adresseFacturation() {
        return $this->belongsTo(Adresse::class);
    }
}
