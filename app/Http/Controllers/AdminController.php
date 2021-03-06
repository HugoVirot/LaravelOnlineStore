<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamme;
use App\Models\Article;
use App\Models\Campagne;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('access_backoffice')) {
            abort(403);
        }

        $gammes = Gamme::all();
        $articles = Article::all();
        $campagnes = Campagne::all();
        $users = User::with('role')->get();
        return view('admin/index', [
            'gammes' => $gammes,
            'articles' => $articles,
            'campagnes' => $campagnes,
            'users' => $users
        ]);
    }
}
