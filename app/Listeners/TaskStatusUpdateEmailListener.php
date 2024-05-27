<?php

namespace App\Listeners;

use App\Events\TaskStatusHasBeenUpdateEvent;
use App\Mail\TaskStatusUpdateMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TaskStatusUpdateEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskStatusHasBeenUpdateEvent $event): void
    {
        Mail::to($event->task->todoList->user->email)->send(new TaskStatusUpdateMail($event->task));
    }
}
