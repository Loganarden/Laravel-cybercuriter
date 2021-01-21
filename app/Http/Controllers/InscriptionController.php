<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function formulaire ()
    {
        return view ('/inscription');
    }

    public function traitement ()
    {
        request()-> validate([
            'name' => ['required'],
            'firstname' => ['required'],
            'email' => ['required','email'],
            'password' => ['required','min:5'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'=> 'pour votre securité le mdp doit contenir au minimum 5 caractères'
        ]);

        $utilisateur = new \App\User;
        $utilisateur->name = request ('name');
        $utilisateur->firstname = request ('firstname');
        $utilisateur->email = request ('email');
        $utilisateur->password = bcrypt (request ('password'));
        $utilisateur->save();

        $resulstat_inscription = auth () -> attempt ([
            'email' => request ('email'),
            'password' => request ('password'),
            'password_confirmation' => request ('password_confimation'),
        ]);

        if ($resulstat_inscription)
        {
            return redirect ('/acceuil');
        }
    }
}
