<?php

namespace App\Console\Commands;

use App\Jobs\StartAllDayTaskJob;
use App\Models\Task;
use Illuminate\Console\Command;

class StartScheduleTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change all schedule tasks status to started.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Task::with('todoList.user')->whereStatus('pending')->whereDate('start_at', now())
            ->cursor()
            ->chunk(10)
            ->each(function ($tasks) {
                dispatch(new StartAllDayTaskJob($tasks));   
            });

    }
}
