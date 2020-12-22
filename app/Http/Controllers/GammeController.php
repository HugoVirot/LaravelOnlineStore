<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamme;
use Illuminate\Support\Facades\DB;

class GammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gammes = Gamme::all();

        if (auth()->user()) {
            $userId = auth()->user()->id;
            $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
            $favorisIds = $favorisIds->toArray();
        } else {
            $favorisIds = null;
        }

        return view('gammes/index', [
            'gammes' => $gammes,
            'favorisIds' => $favorisIds
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
        ]);

        Gamme::create($request->all());
        return redirect()->route('admin.index')->with('message', 'Gamme créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gamme $gamme)
    {
        return view('gammes/edit', ['gamme' => $gamme]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gamme $gamme)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
        ]);

        $gamme->update($request->all());
        return redirect()->route('admin.index')->with('message', 'Gamme modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gamme $gamme)
    {
        $gamme->load('articles');
        foreach ($gamme->articles as $article) {
            $article->delete();
        }
        $gamme->delete();

        return redirect()->route('admin.index')->with('message', 'La gamme a bien été supprimée');
    }
}
