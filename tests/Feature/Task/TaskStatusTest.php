<?php

declare(strict_types=1);

namespace Feature\Task;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskStatusesScreenCanBeRendered(): void
    {
        $this->get(route('task_statuses.index'))
             ->assertOk();
    }

    public function testCreateTaskStatusScreenCanBeRendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get(route('task_statuses.create'))
             ->assertOk();
    }

    public function testCreateTaskStatusScreenCannotBeRenderedForGuest(): void
    {
        $this->get(route('task_statuses.create'))
             ->assertForbidden();
    }

    public function testTaskStatusCanBeCreated(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->make();

        $this->actingAs($user)
             ->post(route('task_statuses.store'), $taskStatus->toArray())
             ->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas($taskStatus->getTable(), $taskStatus->toArray());
    }

    public function testTaskStatusCannotBeCreatedForGuest(): void
    {
        $taskStatus = TaskStatus::factory()->make()->toArray();

        $this->post(route('task_statuses.store'), $taskStatus)
             ->assertForbidden();
    }

    public function testEditTaskStatusScreenCanBeRendered(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $this->actingAs($user)
             ->get(route('task_statuses.edit', $taskStatus))
             ->assertOk();
    }

    public function testEditTaskStatusScreenCannotBeRenderedForGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $this->get(route('task_statuses.edit', $taskStatus))
             ->assertForbidden();
    }

    public function testTaskStatusCanBeUpdated(): void
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->toArray();

        $this->actingAs($user)
             ->patch(route('task_statuses.update', $taskStatus), $data)
             ->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas($taskStatus->getTable(), $data);
    }

    public function testTaskStatusCannotBeUpdatedForGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->toArray();

        $this->patch(route('task_statuses.update', $taskStatus), $data)
             ->assertForbidden();
    }

    public function testTaskStatusCanBeDeleted(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $this->actingAs($user)
             ->delete(route('task_statuses.destroy', $taskStatus))
             ->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing($taskStatus->getTable(), $taskStatus->only('id'));
    }

    public function testTaskStatusCannotBeDeletedForGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $this->delete(route('task_statuses.destroy', $taskStatus))
             ->assertForbidden();
    }
}
