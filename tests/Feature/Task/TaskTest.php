<?php

declare(strict_types=1);

namespace Feature\Task;

use Override;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName;
    private array $formData;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $task = Task::factory()->make();
        $this->tableName = $task->getTable();
        $this->formData = $task->only(
            [
                'name',
                'description',
                'status_id',
                'assigned_to_id',
            ]
        );
    }

    public function testIndexScreenCanBeRendered(): void
    {
        $this->get(route('tasks.index'))
             ->assertOk();
    }

    public function testCreateScreenCanBeRendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get(route('tasks.create'))
             ->assertOk();
    }

    public function testCreateScreenCannotBeRenderedForGuest(): void
    {
        $this->get(route('tasks.create'))
             ->assertForbidden();
    }

    public function testCanBeCreated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post(route('tasks.store'), $this->formData)
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testCannotBeCreatedForGuest(): void
    {
        $this->post(route('tasks.store'), $this->formData)
             ->assertForbidden();
    }

    public function testShowScreenCanBeRendered(): void
    {
        $task = Task::factory()->create();

        $this->get(route('tasks.show', $task))
             ->assertOk();
    }

    public function testEditScreenCanBeRendered(): void
    {
        $task = Task::factory()->create();

        $this->actingAs($task->creator)
             ->get(route('tasks.edit', $task))
             ->assertOk();
    }

    public function testEditScreenCannotBeRenderedForGuest(): void
    {
        $task = Task::factory()->create();

        $this->get(route('tasks.edit', $task))
             ->assertForbidden();
    }

    public function testCanBeUpdated(): void
    {
        $task = Task::factory()->create();

        $this->actingAs($task->creator)
             ->patch(route('tasks.update', $task), $this->formData)
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testCannotBeUpdatedForGuest(): void
    {
        $task = Task::factory()->create();

        $this->patch(route('tasks.update', $task), $this->formData)
             ->assertForbidden();
    }

    public function testCanBeDeleted(): void
    {
        $task = Task::factory()->create();

        $this->actingAs($task->creator)
             ->delete(route('tasks.destroy', $task))
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing($this->tableName, $task->only('id'));
    }

    public function testCannotBeDeletedForNotAuthor(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $this->actingAs($user)
             ->delete(route('tasks.destroy', $task))
             ->assertForbidden();
    }

    public function testCannotBeDeletedForGuest(): void
    {
        $task = Task::factory()->create();

        $this->delete(route('tasks.destroy', $task))
             ->assertForbidden();
    }
}
