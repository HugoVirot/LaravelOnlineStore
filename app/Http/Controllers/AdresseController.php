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
            'code_postal' => 'required|min:5|max:5',
            'ville' => 'required|min:3|max:50',
        ]);

        // ------------- solution 1 ----------------
        // $adresse = new Adresse();
        // $adresse->adresse = $request->input('adresse');
        // $adresse->code_postal = $request->input('code_postal');
        // $adresse->ville = $request->input('ville');
        // $adresse->user_id = $request->input('user_id');
        // $adresse->save();

        // ------------- solution 2 (optimale !)-----------------
        Adresse::create($request->all());

        return redirect()->back()->with('message', 'Adresse enregistrée !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $request->validate([
            'adresse' => 'required|min:3|max:50',
            'code_postal' => 'required|min:3|max:50',
            'ville' => 'required|min:3|max:50',
        ]);

        $adresseId = intval($request->input('adresse_id'));
        $adresse = Adresse::find($adresseId);

        $adresse->update([
            'adresse' => $request->input('adresse'),
            'code_postal' => $request->input('code_postal'),
            'ville' => $request->input('ville'),
        ]);

        return redirect()->back()->with('message', 'L\'adresse a bien été modifiée');
    }


    public function delete(Request $request)
    {
        $adresseId = intval($request->input('adresse_id'));
        $adresse = Adresse::find($adresseId);
        $adresse->delete();
        return redirect()->back()->with('message', 'L\'adresse a bien été supprimée');
    }
}
