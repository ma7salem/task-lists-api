<?php
Namespace App\Actions\TodoList;

use App\Actions\Action;

class TodoListDeleteAction extends Action
{
    protected function handle(array $data)
    {
        $todoList = $data['todo'];
        return $todoList->delete();
    }
}