<?php
Namespace App\Actions\TodoList;

use App\Actions\Action;
use App\Models\TodoList;

class TodoListUpdateAction extends Action
{
    protected function handle(array $data)
    {
        $inputs   = $data['inputs'];
        $todoList = $data['todo'];
        $todoList->update($inputs);
        return $todoList->fresh();
    }
}