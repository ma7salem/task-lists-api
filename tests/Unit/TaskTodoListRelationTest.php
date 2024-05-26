<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTodoListRelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_task_belongs_to_a_todo_list(): void
    {
        $task = Task::factory()->create();
        $this->assertNotNull($task->todoList);
        $this->assertInstanceOf(TodoList::class, $task->todoList);
    }
}
