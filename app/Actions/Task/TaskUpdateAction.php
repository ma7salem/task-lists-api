<?php
Namespace App\Actions\Task;

use App\Actions\Action;
use App\Events\TaskStatusHasBeenUpdateEvent;

class TaskUpdateAction extends Action
{
    protected function handle(array $data)
    {
        $inputs     = $data['inputs'];
        $task       = $data['task'];
        $status     = $task->status;
        $task->update($inputs);
        TaskStatusHasBeenUpdateEvent::dispatchIf($status != $task->status, $task);
        return $task;
    }
}