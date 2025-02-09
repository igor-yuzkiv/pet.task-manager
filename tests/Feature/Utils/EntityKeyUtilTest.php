<?php

namespace Tests\Feature\Utils;

use App\Domains\Project\Models\Project;
use App\Utils\EntityKeyUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntityKeyUtilTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_entity_key_from_name()
    {
        $key = EntityKeyUtil::generateKey('Regular Project Name');
        $this->assertEquals('RPN', $key);
    }

    public function test_generate_entity_key_with_single_word_entity_name()
    {
        $key = EntityKeyUtil::generateKey('Entity');
        $this->assertEquals('ENT', $key);
    }

    public function test_generate_entity_key_with_large_entity_name()
    {
        $key = EntityKeyUtil::generateKey('This is a very large entity name that should be truncated');

        $this->assertEquals('TIA', $key);
    }

    public function test_generate_entity_key_error_when_name_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        EntityKeyUtil::generateKey('');
    }

    public function test_generate_entity_uniq_key_from_name()
    {
        $key = EntityKeyUtil::generateEntityUniqKey('Regular Project Name', new Project, 'key');
        $this->assertEquals('RPN-1', $key);
    }

    public function test_generate_entity_uniq_key_if_already_exists()
    {
        Project::create([
            'key'         => 'RPN-1',
            'name'        => 'Regular Project Name',
            'description' => 'Description',
            'status'      => 'active',
        ]);

        $key = EntityKeyUtil::generateEntityUniqKey('Regular Project Name', new Project, 'key');

        $this->assertEquals('RPN-2', $key);
    }

    public function test_generate_entity_uniq_key_error_when_name_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        EntityKeyUtil::generateEntityUniqKey('', new Project, 'key');
    }
}
