<?php
Namespace App\Actions\Task;

use App\Actions\Action;

class TaskUpdateAction extends Action
{
    protected function handle(array $data)
    {
        $inputs     = $data['inputs'];
        $task       = $data['task'];
        $task->update($inputs);
        return $task->fresh();
    }
}