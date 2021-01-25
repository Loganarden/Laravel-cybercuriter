<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ConnexionController extends Controller
{
    public function formulaireConnexion()
    {
        return view('/connexion');
    }

    public function traitementConnexion()
    {
        request()-> validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $resultat = auth () -> attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);

        if ($resultat)
        {
            return redirect ('/welcome');
        }

        return back () ->withInput() ->WithErrors(
            ['email' => 'identifiant incorecte.',]
        );
    }

    public function deconnexion()
    {
        auth() ->logout();

        return redirect('/');
    }
}
