<?php
Namespace App\Actions\Task;

use App\Actions\Action;

class TaskDeleteAction extends Action
{
    protected function handle(array $data)
    {
        $task = $data['task'];
        return $task->delete();
    }
}