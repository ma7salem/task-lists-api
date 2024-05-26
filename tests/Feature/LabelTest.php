<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $label;

    public function setUp(): void 
    {
        parent::setUp();
        $this->user = $this->actAsUser();
        $this->label = Label::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_getting_all_labels(): void
    {
        Label::factory()->create();
        $response = $this->getJson(route('labels.index'))
                    ->assertOk()
                    ->json();
        
        $this->assertEquals(1, count($response));
    }

    public function test_getting_single_label(): void 
    {
        $response = $this->getJson(route('labels.show', $this->label->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($this->label->id, $response['id']);
    }

    public function test_store_one_label(): void 
    {
        $inputs = [
            'title' => 'design tasks',
            'color' => 'blue'
        ];
        $this->postJson(route('labels.store'), $inputs)
        ->assertCreated();

        $this->assertDatabaseHas('labels', ['title' => $inputs['title'], 'user_id' => $this->user->id]);
    }

    public function test_update_on_label(): void 
    {
        $color = 'skyblue';
        $this->patchJson(route('labels.update', $this->label->id), ['color' => $color, 'title' => $this->label->title])
        ->assertOk();    

        $this->assertDatabaseHas('labels', ['color' => $color, 'user_id' => $this->user->id]);
    }

    public function test_delete_one_label(): void 
    {
        $this->deleteJson(route('labels.destroy', $this->label->id))
        ->assertNoContent();    

        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
        $this->assertDatabaseCount('labels', 0);

    }
}
