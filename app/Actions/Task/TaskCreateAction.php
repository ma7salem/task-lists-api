<?php
Namespace App\Actions\Task;

use App\Actions\Action;
use App\Models\Task;

class TaskCreateAction extends Action
{
    protected function handle(array $data)
    {
        $todo   = $data['todo'];
        return $todo->tasks()->create($data['inputs']);
    }
}