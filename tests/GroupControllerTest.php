<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAjouterGroupe()
    {
        // Créer des données de groupe pour le test
        $groupData = [
            'name' => 'Test Group',
        ];

        // Faire une requête pour ajouter un nouveau groupe avec les données spécifiées
        $response = $this->postJson('/api/groups', $groupData);

        // Vérifier que la requête est réussie et que les données retournées correspondent aux données du groupe ajouté
        $response->assertStatus(201)
            ->assertJson(['message' => 'Le groupe a été ajouté avec succès']);

        // Vérifier que le groupe a été créé dans la base de données
        $this->assertDatabaseHas('groups', $groupData);
    }

    public function testMettreAJourGroupe()
    {
        // Créer un groupe pour le test
        $group = Group::factory()->create();

        // Données mises à jour pour le groupe
        $updatedGroupData = [
            'name' => 'Updated Group Name',
        ];

        // Faire une requête pour mettre à jour le groupe avec les nouvelles données spécifiées
        $response = $this->putJson("/api/groups/{$group->id}", $updatedGroupData);

        // Vérifier que la requête est réussie et que les données retournées correspondent aux données mises à jour du groupe
        $response->assertStatus(200)
            ->assertJson(['message' => 'Le groupe a été mis à jour avec succès']);

        // Vérifier que le groupe a été mis à jour dans la base de données
        $this->assertDatabaseHas('groups', $updatedGroupData);
    }

    public function testSupprimerGroupe()
    {
        // Créer un groupe pour le test
        $group = Group::factory()->create();

        // Faire une requête pour supprimer le groupe
        $response = $this->deleteJson("/api/groups/{$group->id}");

        // Vérifier que la requête est réussie et que les données retournées indiquent que le groupe a été supprimé avec succès
        $response->assertStatus(200)
            ->assertJson(['message' => 'Le groupe a été supprimé avec succès']);

        // Vérifier que le groupe a été supprimé de la base de données
        $this->assertDeleted($group);
    }

    public function testAssignerUtilisateurAuGroupe()
    {
        // Créer un groupe et un utilisateur pour le test
        $group = Group::factory()->create();
        $user = User::factory()->create();

        // Faire une requête pour assigner l'utilisateur au groupe
        $response = $this->postJson("/api/groups/{$group->id}/users/{$user->id}");

        // Vérifier que la requête est réussie et que les données retournées indiquent que l'utilisateur a été assigné au groupe avec succès
        $response->assertStatus(200)
            ->assertJson(['message' => 'Utilisateur assigné au groupe avec succès']);

        // Vérifier que l'utilisateur a été assigné au groupe dans la base de données
        $this->assertDatabaseHas('group_user', ['group_id' => $group->id, 'user_id' => $user->id]);
    }
}
