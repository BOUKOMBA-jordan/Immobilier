<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;

class HomeController extends Controller
{
    public function index () {
        // Utilisation de paginate pour obtenir les enregistrements avec pagination
        $vehicles = Vehicle::with('pictures')->available()->recent()->paginate(4);
        
        // Exemple de mise à jour de mot de passe (commenté pour ne pas être exécuté accidentellement)
        // $user = User::first();
        // $user->password = '0000';
        // dd($user->password, $user);
       
        return view('home', ['vehicles' => $vehicles]);
    }
}