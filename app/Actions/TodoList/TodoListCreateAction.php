<?php
Namespace App\Actions\TodoList;

use App\Actions\Action;
use App\Models\TodoList;

class TodoListCreateAction extends Action
{
    protected function handle(array $data)
    {
        return TodoList::create($data);
    }
}