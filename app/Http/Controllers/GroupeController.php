<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Groupe;

class GroupeController extends Controller
{
    // Assurez-vous d'importer le modèle Group si vous l'avez

    public function ajouter(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Création d'un nouveau groupe et enregistrement dans la base de données
        Group::create([
            'name' => $request->input('name'),
            // Vous pouvez ajouter d'autres attributs du groupe ici
        ]);

        return response()->json(['message' => 'Le groupe a été ajouté avec succès'], 201);
    }

}
