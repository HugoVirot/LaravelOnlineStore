<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Http\Request;

class AdresseController extends Controller
{

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
     * Show the form for editing the specified resource.
     *
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
        $adresse->user_id = $request->input('user_id');
        $adresse->adresse = $request->input('adresse');
        $adresse->code_postal = $request->input('code_postal');
        $adresse->ville = $request->input('ville');
        $adresse->save();

        return redirect()->route('home')->with('message', 'L\'adresse a bien été modifiée');
    }
}
