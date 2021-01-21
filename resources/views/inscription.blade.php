@extends('layout')
    
    @section ('contenu')

        <div>
            INscription
        </div>

        <div>
            <fieldset>
                <form action="/connexion" method="post">
                {{ csrf_field() }}

                    <p><input type="text" name="name" id="name" placeholder="Nom"></p>
                        @if($errors->has('name'))
                        <p>{{ $errors->first ('name') }}</p>
                        @endif

                    <p><input type="text" name="firstname" id="firstname" placeholder="Prenom"></p>
                        @if($errors->has('firstname'))
                        <p>{{ $errors->first ('firstname') }}</p>
                        @endif

                    
                    <p><input type="text" name="email" id="email" placeholder="Email"></p>
                        @if($errors->has('email'))
                        <p>{{ $errors->first ('email') }}</p>
                        @endif

                    <p><input type="text" name="password" id="password" placeholder="Mot de passe"></p>
                        @if($errors->has('password'))
                        <p>{{ $errors->first ('password') }}</p>
                        @endif

                    <p><input type="submit" value="M'inscrire"></p>
                </form>
            </fieldset>
        </div>


    @endsection