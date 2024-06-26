<?php

namespace Tests\Feature;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    private $task;

    public function setUp(): void 
    {
        parent::setUp();
        $this->actAsUser();
        $this->task = Task::factory()->create();
        
    }

    public function test_geting_all_tasks(): void
    {
        $response = $this->getJson(route('tasks.index', $this->task->todo_list_id))
                    ->assertOk()
                    ->json();
        $this->assertEquals(1, count($response));
    }

    public function test_geting_one_task(): void 
    {
        $response = $this->getJson(route('tasks.show', [$this->task->id]))
                    ->assertOk()
                    ->json();
        $this->assertEquals($this->task->id, $response['id']);    
    }

    public function test_store_one_not_schedule_task(): void 
    {
        $name = 'new task added';
        $response = $this->postJson(route('tasks.store', $this->task->todo_list_id), ['name' => $name])
                    ->assertCreated()
                    ->json();
        $this->assertEquals($name, $response['name']);    
        $this->assertDatabaseHas('tasks', ['name' => $name, 'todo_list_id' => $this->task->todo_list_id]);
    }

    public function test_while_storing_one_task_name_field_is_required(): void 
    {
        $this->withExceptionHandling();

        $this->postJson(route('tasks.store', $this->task->todo_list_id))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);   
    }

    public function test_store_onet_schedule_task(): void 
    {
        $name  = 'new task added';
        $start = Carbon::now()->addDays(1)->format('Y-m-d H:i:s'); 
        $response = $this->postJson(route('tasks.store', $this->task->todo_list_id), ['name' => $name, 'start_at' => $start])
                    ->assertCreated()
                    ->json();
        $this->assertEquals($start, $response['schedule']);    
        $this->assertDatabaseHas('tasks', ['name' => $name, 'start_at' => $start, 'todo_list_id' => $this->task->todo_list_id]);
    }

    public function test_while_storing_one_schedule_task_start_at_field_is_valid_format(): void 
    {
        $this->withExceptionHandling();
        $inputs = ['start_at' => Carbon::now()->addDays(1)->format('Y-m-d'), 'name' => 'test'];
        $this->postJson(route('tasks.store', $this->task->todo_list_id), $inputs)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['start_at']);   
    }

    public function test_while_storing_one_schedule_task_start_at_field_is_valid_date_and_after_today(): void 
    {
        $this->withExceptionHandling();
        $inputs = ['start_at' => Carbon::now()->subDays(1)->format('Y-m-d  H:i:s'), 'name' => 'test'];
        $this->postJson(route('tasks.store', $this->task->todo_list_id), $inputs)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['start_at']);   
    }

    public function test_update_one_task(): void 
    {
        Event::fake();
        $name = 'task updated';
        $this->patchJson(route('tasks.update', [$this->task->id]), ['name' => $name, 'status' => 'completed'])
        ->assertOk();
        $this->assertDatabaseHas('tasks', ['name' => $name, 'todo_list_id' => $this->task->todo_list_id]);
    }

    public function test_while_updating_one_task_name_field_is_required(): void 
    {
        $this->withExceptionHandling();

        $this->patchJson(route('tasks.update', [$this->task->id]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);   
    }

    public function test_destroy_one_task(): void 
    {
        $this->deleteJson(route('tasks.destroy', [$this->task->id]))
        ->assertNoContent();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }
}
