<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    // Méthode pour ajouter un groupe
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

    // Méthode pour mettre à jour un groupe
    public function update(Request $request, $id)
    {

        $group = Group::findOrFail($id);

        // Validation des données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Mise à jour des attributs du groupe
        $group->name = $request->input('name');
        // Vous pouvez mettre à jour d'autres attributs du groupe ici

        // Enregistrement des modifications dans la base de données
        $group->save();

        return response()->json(['message' => 'Le groupe a été mis à jour avec succès'], 200);
    }

    // Méthode pour supprimer un groupe
    public function delete($id)
    {
        //dd('test');
        // Recherche du groupe à supprimer
        $group = Group::findOrFail($id);

        // Suppression du groupe
        $group->delete();

        return response()->json(['message' => 'Le groupe a été supprimé avec succès'], 200);
    }


    public function assignUserToGroup(Request $request, $groupId, $userId)
    {
        $group = Group::findOrFail($groupId);
        $user = User::findOrFail($userId);

        $group->users()->syncWithoutDetaching($user);

        return response()->json(['message' => 'Utilisateur assigné au groupe avec succès'], 200);
    }





}
