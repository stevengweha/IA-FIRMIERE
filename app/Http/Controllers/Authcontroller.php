<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showForm(Request $request)
    {
        // Vérifie si un type de formulaire est demandé (connexion ou inscription)
        $formType = $request->query('form', 'login'); // Par défaut "login"

        return view('welcome', compact('formType'));
    }

    public function login(Request $request)
    {
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                // Authentification réussie
                if ($request->hasFile('photo')) {
                    $path = $request->file('photo')->store('photos', 'public');
                    Auth::user()->update(['photo' => $path]);
                }
                return redirect()->intended('dashboard');
            }
    
            // Authentification échouée
            return redirect()->back()->withErrors([
                'email' => 'Les informations d\'identification ne correspondent pas.',
            ]);
    }
    public function register(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'adresse' => 'required|string|max:255',
        'code_postal' => 'required|string|max:10',
        'ville' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $data = $request->all();
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('photos', 'public');
    }

    $data['password'] = Hash::make($data['password']);

    $user = User::create($data);

    Auth::login($user);

    return redirect()->intended('login');
    }
}
