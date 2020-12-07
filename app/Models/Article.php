<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function commandes(){
        return $this->belongsToMany(Commandes::class);
    }

    public function campagnes(){
        return $this->belongsToMany(Campagne::class);
    }

    public function favoris(){
        return $this->belongsToMany(Favori::class);
    }

    public function avis() 
    {
        return $this->hasMany(Avis::class);
    }
}
