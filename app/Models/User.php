<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Article;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'pseudo', 'role_id', 'updated_at', 'created_at', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function adresses()
    {
        return $this->hasMany(Adresse::class);
    }

    //pour table intermédiaire favoris (= users_articles)
    public function favoris()
    {
        return $this->belongsToMany(Article::class, 'favoris');
    }

    public function isAdmin()
    {
        return auth()->user()->role_id == 2;
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    // permet de vérifier si un article est dans les favoris de l'utilisateur connecté
    // dans la vue, on utilise la syntaxe suivante : @if (Auth::user()->isInFavorites($article))
    
    public function isInFavorites(Article $article)
    {
        return $article->users()->where('user_id', $this->id)->exists();
    }
}
