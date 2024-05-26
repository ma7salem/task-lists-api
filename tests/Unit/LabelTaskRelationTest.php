<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTaskRelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_a_label_has_many_tasks(): void
    {
        $label = Label::factory()->create();
        Task::factory()->create(['label_id' => $label->id]);
        
        $this->assertInstanceOf(Task::class, $label->tasks()->first());
    }
}
