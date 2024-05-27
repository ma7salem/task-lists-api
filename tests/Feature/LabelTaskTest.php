<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTaskTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $label;
    private $task;

    public function setUp(): void 
    {
        parent::setUp();
        $this->user  = $this->actAsUser();
        $this->label = Label::factory()->create(['user_id' => $this->user->id]);
        $this->task  = Task::factory()->create();
    }

    public function test_store_one_task_with_label_and_details(): void 
    {
        $inputs   = [
            'name'     => 'test task with label and details',
            'label_id' => $this->label->id,
            'details'  => 'test details task'
        ];
        $response = $this->postJson(route('tasks.store', $this->task->todo_list_id), $inputs)
                    ->assertCreated()
                    ->json();
        $this->assertEquals($inputs['label_id'], $response['label']['id']);    
        $this->assertDatabaseHas('tasks', $inputs);
    }

    public function test_while_storing_one_task_label_id_field_is_valid_id(): void 
    {
        $this->withExceptionHandling();
        $inputs   = [
            'name'     => 'test task with label and details',
            'label_id' => 2,
            'details'  => 'test details task'
        ];
        $this->postJson(route('tasks.store', $this->task->todo_list_id), $inputs)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['label_id']);   
    }

    public function test_update_one_task_with_label_id_and_details(): void 
    {
        $inputs   = [
            'name'     => 'update task with label and details',
            'label_id' => $this->label->id,
            'details'  => 'test details task'
        ];
        $this->patchJson(route('tasks.update', [$this->task->id]), $inputs)
        ->assertOk();
        $this->assertDatabaseHas('tasks', $inputs);
    }

    public function test_while_updating_one_task_label_id_field_is_valid_id(): void 
    {
        $this->withExceptionHandling();
        $inputs   = [
            'label_id' => 2
        ];
        $this->patchJson(route('tasks.update', [$this->task->id]), $inputs)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['label_id']);   
    }
}
