<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account(User $user)
    {
        $user = User::find($user->id);
        $user->load('adresses');
        $user->load('commandes');
        return view('user.account', ['user' => $user]);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'confirmed',
        ]);

        $user = User::find(auth()->user()->id);

        $currentPassword = $request->input('currentPassword');
        $currentPasswordDatabase = $user->password;
        $newPassword = $request->input('newPassword');


        if (Hash::check($currentPassword, $currentPasswordDatabase)) {  // test 1 : mdp actuel saisi = mdp actuel base 

            if (($currentPassword !== $newPassword)) {    // test 2 : ancien et nouveau mdp différents

                $user->update(['password' => Hash::make($newPassword)]);
                return redirect()->route('home')->with('message', 'Le mot de passe a bien été modifié');

            } else {
                return redirect()->back()->withErrors(['Attention !', 'ancien et nouveau mot de passe identiques !']);
            }

        } else {
            return redirect()->back()->withErrors(['Attention !', 'mot de passe actuel saisi incorrect']); 
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'prenom' => 'required|min:3|max:50',
            'nom' => 'required|min:3|max:50',
            'pseudo' => 'required|min:3|max:50',
            'email' => 'required|min:6|max:50'
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'prenom' => $request->input('prenom'),
            'nom' => $request->input('nom'),
            'pseudo' => $request->input('pseudo'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('home')->with('message', 'Le profil a bien été modifié');
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
