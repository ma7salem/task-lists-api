<?php
Namespace App\Actions\TodoList;

use App\Actions\Action;

class TodoListCreateAction extends Action
{
    protected function handle(array $data)
    {
        return auth()->user()->todoLists()->create($data);
    }
}