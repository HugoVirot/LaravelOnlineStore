<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'adresse' => 'required|min:3|max:50',
            'code_postal' => 'required|min:3|max:50',
            'ville' => 'required|min:3|max:50',
        ]);
          
        $adresse = new Adresse();
        $adresse->adresse = $request->input('adresse');
        $adresse->code_postal = $request->input('code_postal');
        $adresse->ville = $request->input('ville');
        $adresse->user_id = $request->input('user_id');
        $adresse->save();

        return redirect()->route('home')->with('message', 'Adresse enregistrée !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adresse $adresse)
    {
        $request->validate([
            'adresse' => 'required|min:3|max:50',
            'code_postal' => 'required|min:3|max:50',
            'ville' => 'required|min:3|max:50',
        ]);

        // $adresse = Adresse::where('user_id', $request->input('user_id'));
        $adresse->adresse = $request->input('user_id');
        $adresse->adresse = $request->input('code_postal');
        $adresse->adresse = $request->input('ville');
        $adresse->save();

        return redirect()->route('home')->with('message', 'L\'adresse a bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
