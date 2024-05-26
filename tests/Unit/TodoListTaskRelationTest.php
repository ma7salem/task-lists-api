<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTaskRelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_a_todo_list_has_many_tasks(): void
    {
        $todoList = TodoList::factory()->create();
        $todoList->tasks()->create(['name' => 'naw task']);
        
        $this->assertInstanceOf(Task::class, $todoList->tasks()->first());
    }
}
