<?php

declare(strict_types=1);

namespace Feature;

use Override;
use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName;
    private array $formData;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $label = Label::factory()->make();
        $this->tableName = $label->getTable();
        $this->formData = $label->only(
            [
                'name',
                'description',
            ]
        );
    }

    public function testIndexScreenCanBeRendered(): void
    {
        $this->get(route('labels.index'))
             ->assertOk();
    }

    public function testCreateScreenCanBeRendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get(route('labels.create'))
             ->assertOk();
    }

    public function testCreateScreenCannotBeRenderedForGuest(): void
    {
        $this->get(route('labels.create'))
             ->assertForbidden();
    }

    public function testCanBeCreated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post(route('labels.store'), $this->formData)
             ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testCannotBeCreatedForGuest(): void
    {
        $this->post(route('labels.store'), $this->formData)
             ->assertForbidden();
    }

    public function testEditScreenCanBeRendered(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $this->actingAs($user)
             ->get(route('labels.edit', $label))
             ->assertOk();
    }

    public function testEditScreenCannotBeRenderedForGuest(): void
    {
        $label = Label::factory()->create();

        $this->get(route('labels.edit', $label))
             ->assertForbidden();
    }

    public function testCanBeUpdated(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $this->actingAs($user)
             ->patch(route('labels.update', $label), $this->formData)
             ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testCannotBeUpdatedForGuest(): void
    {
        $label = Label::factory()->create();

        $this->patch(route('labels.update', $label), $this->formData)
             ->assertForbidden();
    }

    public function testCanBeDeleted(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $this->actingAs($user)
             ->delete(route('labels.destroy', $label))
             ->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing($this->tableName, $label->only('id'));
    }

    public function testCannotBeDeletedForGuest(): void
    {
        $label = Label::factory()->create();

        $this->delete(route('labels.destroy', $label))
             ->assertForbidden();
    }
}
