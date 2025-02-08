<?php

namespace Tests\Feature\Project\Services;

use App\Domains\Project\Models\Project;
use App\Domains\Project\Services\GenerateProjectKey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateProjectKeyTest extends TestCase
{
    use RefreshDatabase;

    protected GenerateProjectKey $generateProjectKey;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateProjectKey = app(GenerateProjectKey::class);
    }

    public function test_generate_project_key_from_name()
    {
        $key = $this->generateProjectKey->handle('Regular Project Name');
        $this->assertEquals('RPN-1', $key);
    }

    public function test_increment_project_key_if_already_exists()
    {
        Project::create([
            'key'         => 'RPN-1',
            'name'        => 'Regular Project Name',
            'description' => 'Description',
            'status'      => 'Active',
        ]);

        $key = $this->generateProjectKey->handle('Regular Project Name');
        $this->assertEquals('RPN-2', $key);
    }

    public function test_generate_project_key_with_single_word_project_name()
    {
        $key = $this->generateProjectKey->handle('Project');
        $this->assertEquals('PRO-1', $key);
    }

    public function test_generate_project_key_with_large_project_name()
    {
        $key = $this->generateProjectKey->handle('This is a very large project name that should be truncated');
        $this->assertEquals('TIA-1', $key);
    }

    public function test_generate_project_key_error_when_name_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->generateProjectKey->handle('');
    }
}
