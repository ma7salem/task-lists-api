<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private $list;

    public function setUp(): void 
    {
        parent::setup(); 
        $this->list = TodoList::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_show_all_todo_lists(): void
    {
        $response = $this->getJson(route('todo-lists.index'));
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals($this->list->name, $response->json()[0]['name']);
    }

    public function test_show_one_todo_list(): void 
    {
        $response = $this->getJson(route('todo-lists.show', $this->list->id))
                    ->assertOk(200)
                    ->json();
        $this->assertEquals($response['name'], $this->list->name);
    }

    public function test_store_one_todo_list(): void 
    {
        $list       = TodoList::factory()->make();
        $inputs     = ['name' => $list->name];
        $response   = $this->postJson(route('todo-lists.store'), $inputs)
                      ->assertCreated()
                      ->json();
        $this->assertEquals($list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', $inputs);
    }

    public function test_while_storing_one_todo_list_name_field_is_required(): void 
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-lists.store'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);   
    }

    public function test_destroy_one_todo_list(): void 
    {
        $this->deleteJson(route('todo-lists.destroy', $this->list->id))
        ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['id' => $this->list->id]);
    }

    public function test_update_one_todo_list() : void 
    {
        $this->patchJson(route('todo-lists.update', $this->list->id), ['name' => 'updated name'])
        ->assertOk();
        
        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'updated name']);
    }

    public function test_while_updating_one_todo_list_name_field_is_required(): void 
    {
        $this->withExceptionHandling();

        $this->patchJson(route('todo-lists.update', $this->list->id))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);   
    }

}
