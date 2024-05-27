<?php

namespace App\Jobs;

use App\Actions\Task\TaskUpdateAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartAllDayTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tasks;
    /**
     * Create a new job instance.
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->tasks){
            $this->tasks->each(function ($task) {
                TaskUpdateAction::run(['inputs' => ['status' => 'started'], 'task' => $task]);
            });
        }
    }
}
