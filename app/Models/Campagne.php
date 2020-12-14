<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    use HasFactory;

    public function articles(){
        return $this->belongsToMany(Article::class, 'campagne_articles');
    }
}
