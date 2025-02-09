<?php

namespace Tests\Feature\Project\Http;

use App\Domains\Project\Models\Project;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_get_projects_success()
    {
        $this->actingAs($this->user);

        $response = $this->getJson(route('api.projects.index'));

        $response->assertStatus(200);
    }

    public function test_get_project_failed_if_unauthenticated()
    {
        $response = $this->getJson(route('api.projects.index'));

        $response->assertStatus(401);
    }

    public function test_create_project_success()
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('api.projects.create'), [
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response->assertStatus(201);
    }

    public function test_create_project_failed_if_unauthenticated()
    {
        $response = $this->postJson(route('api.projects.create'), [
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response->assertStatus(401);
    }

    public function test_create_project_failed_if_invalid_data()
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('api.projects.create'), [
            'key'  => 'Long key that should not be accepted',
            'name' => false,
        ]);

        $response->assertStatus(422);
    }

    public function test_create_project_failed_if_key_duplicated()
    {
        $this->actingAs($this->user);

        Project::create([
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response = $this->postJson(route('api.projects.create'), [
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response->assertStatus(422);
    }

    public function test_update_project_success()
    {
        $this->actingAs($this->user);

        $project = Project::create([
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response = $this->putJson(route('api.projects.update', $project->id), [
            'key'         => 'TU-1',
            'name'        => 'Test Project Updated',
            'description' => 'This is a test project updated',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_project_failed_if_unauthenticated()
    {
        $project = Project::create([
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response = $this->putJson(route('api.projects.update', $project->id), [
            'key'         => 'TEST UPDATED',
            'name'        => 'Test Project Updated',
            'description' => 'This is a test project updated',
        ]);

        $response->assertStatus(401);
    }

    public function test_update_project_failed_if_invalid_data()
    {
        $this->actingAs($this->user);

        Project::create([
            'key'         => 'TP-1',
            'name'        => 'TEST 1',
            'description' => 'This is a test project',
        ]);

        $project = Project::create([
            'key'         => 'TEST',
            'name'        => 'Test Project',
            'description' => 'This is a test project',
        ]);

        $response = $this->putJson(route('api.projects.update', $project->id), [
            'key'  => 'TP-1',
            'name' => false,
        ]);

        $response->assertStatus(422);
    }

    public function test_update_project_failed_if_project_not_exists()
    {
        $this->actingAs($this->user);

        $response = $this->putJson(route('api.projects.update', 1), [
            'key'         => 'TEST UPDATED',
            'name'        => 'Test Project Updated',
            'description' => 'This is a test project updated',
        ]);

        $response->assertStatus(404);
    }
}
