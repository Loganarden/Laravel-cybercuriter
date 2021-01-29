<?php
// 7Cj2oo7YPdNWG7N04LU8FiiJVVD6mG7xIDT6mjRuZ79runHEOBS1qnhfXRw34EeR
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Mail;

class ConnexionController extends Controller
{
    public function formulaireConnexion()
    {
        return view('/connexion');
    }

    public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    $user = User::where('email', $credentials['email'])->first();
                    if (date('s') < $user->temps && $user->temps != null)
                    {
                        return response()->json(['error' => 'echec trop de tentative'], 400);
                    }
                    else {
                        $user->temps = null;
                        $user->save();
                    }
                    
                    $user->tentative = $user->tentative + 1;
                    $user->save();
                    $reste = $user->tentative - 1;
                    if ($user->tentatives > 3)
                    {
                        log::debug('trop de tentative echoué, reéssayer plus tard.');
                        Mail::to($user->email)->send(new authmail());
                        
                        $user->tentative = 0;
                        $user->temps = date('s') + 30;
                        $user->save();
                        return response()->json(['message' => 'trop de tentative'], 401);
                    }
                    else {
                        return response()->json(['message' => 'il vous reste' . ' ' . (3-$reste) . ' ' . 'tentative.']);
                    }

                }

            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $user = User::where('email', $credentials['email'])->first();
            $user->tentative = 0;
            $user->save();

            return response()->json(compact('token'));
        }

        public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'firstname' => $request->get('firstname'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'tentative' => 0,
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user','token'),201);
        }

    // public function traitementConnexion()
    // {
    //     request()-> validate([
    //         'email' => ['required','email'],
    //         'password' => ['required'],
    //     ]);

    //     $resultat = auth () -> attempt([
    //         'email' => request('email'),
    //         'password' => request('password'),
    //     ]);

    //     if ($resultat)
    //     {
    //         return redirect ('/welcome');
    //     }

    //     return back () ->withInput() ->WithErrors(
    //         ['email' => 'identifiant incorecte.',]
    //     );
    // }

    public function getAuthenticatedUser()
    {
            try {

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    }

    public function deconnexion()
    {
        auth() ->logout();

        return redirect('/');
    }
}
