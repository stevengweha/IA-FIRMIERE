<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Récupérez les données de santé de l'utilisateur ici
        $healthData = [
            'weight' => '120',
            'height' => '175cm',
            'bloodPressure' => '140/80',
            'latestHeartRate' => '120',
            'latestBloodPressure' => '150/80',
            'latestWeight' => '80kg',
            // Ajoutez d'autres données de santé ici
            
        ];
        // Données pour le graphique de fréquence cardiaque
        $heartRateData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],  // Mois
            'values' => [70, 72, 75, 88, 80],  // Valeurs de la fréquence cardiaque
        ];

        return view('dashboard.dashboard', [
            'user' => $user,
            'healthData' => $healthData,
            'heartRateData'=> $heartRateData
        ]);
    }
}
