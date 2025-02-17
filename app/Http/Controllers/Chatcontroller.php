<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Chatcontroller extends Controller
{
    public function handleChat(Request $request)
    {
        $message = $request->input('message');
        // Logique pour traiter le message et obtenir une réponse de l'IA
        $response = "Ceci est une réponse de l'IA à votre message : " . $message;

        return response()->json(['response' => $response]);
    }
}
