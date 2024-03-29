<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListeUtilisateurs()
    {
        // Créer des utilisateurs pour le test
        $users = User::factory()->count(3)->create();

        // Faire une requête pour récupérer la liste des utilisateurs
        $response = $this->getJson('/api/users');

        // Vérifier que la requête est réussie et que les données retournées correspondent aux utilisateurs créés
        $response->assertStatus(200)
            ->assertJsonCount(3) // Vérifie le nombre d'utilisateurs retournés
            ->assertJson($users->toArray()); // Vérifie que les données retournées correspondent aux utilisateurs créés
    }

    public function testAfficherUtilisateur()
    {
        // Créer un utilisateur pour le test
        $user = User::factory()->create();

        // Faire une requête pour afficher l'utilisateur créé
        $response = $this->getJson('/api/users/' . $user->id);

        // Vérifier que la requête est réussie et que les données retournées correspondent à l'utilisateur créé
        $response->assertStatus(200)
            ->assertJson($user->toArray()); // Vérifie que les données retournées correspondent à l'utilisateur créé
    }

    public function testAjouterUtilisateur()
    {
        // Créer des données d'utilisateur pour le test
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password'
        ];

        // Faire une requête pour ajouter un nouvel utilisateur avec les données spécifiées
        $response = $this->postJson('/api/users', $userData);

        // Vérifier que la requête est réussie et que les données retournées correspondent aux données de l'utilisateur ajouté
        $response->assertStatus(201)
            ->assertJson(['message' => 'Utilisateur ajouté avec succès', 'user' => $userData]);
    }

    // Tests similaires pour les méthodes "update" et "destroy"
}
