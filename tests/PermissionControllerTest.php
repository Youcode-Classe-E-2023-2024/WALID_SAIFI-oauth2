<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAjouterGroupe()
    {
        $response = $this->postJson('/api/groups', ['name' => 'Test Group']);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Le groupe a été ajouté avec succès']);

        $this->assertDatabaseHas('groups', ['name' => 'Test Group']);
    }

    public function testMiseAJourGroupe()
    {
        $group = Group::factory()->create();

        $response = $this->putJson("/api/groups/{$group->id}", ['name' => 'Updated Group Name']);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Le groupe a été mis à jour avec succès']);

        $this->assertDatabaseHas('groups', ['id' => $group->id, 'name' => 'Updated Group Name']);
    }

    public function testSupprimerGroupe()
    {
        $group = Group::factory()->create();

        $response = $this->deleteJson("/api/groups/{$group->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Le groupe a été supprimé avec succès']);

        $this->assertDeleted($group);
    }

    public function testAssignerUtilisateurAuGroupe()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson("/api/groups/{$group->id}/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Utilisateur assigné au groupe avec succès']);

        $this->assertDatabaseHas('group_user', ['group_id' => $group->id, 'user_id' => $user->id]);
    }
}
