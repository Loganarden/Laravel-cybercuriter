<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'password' => ['required','min:6'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'=> 'pour votre securité le mdp doit contenir au minimum 6 caractères'
        ]);

        $utilisateur = new \App\Models\User;
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
            return redirect ('/');
        }
    }
}

//{"user":{"name":"jhon","firstname":"attend","email":"jhon@gmail.com","updated_at":"2021-01-28T08:04:52.000000Z","created_at":"2021-01-28T08:04:52.000000Z","id":1},"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9pbnNjcmlwdGlvbiIsImlhdCI6MTYxMTgyMTA5MiwiZXhwIjoxNjExODI0NjkyLCJuYmYiOjE2MTE4MjEwOTIsImp0aSI6IkRqN2NMZ3l3OVZBNFZWVFUiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.N_wxx-kwDZAq9ogD-D1k2W2K9Ve2hvsA24xcvdh0N3M"}