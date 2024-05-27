<?php
Namespace App\Actions\TodoList;

use App\Actions\Action;
use App\Models\TodoList;

class TodoListUpdateAction extends Action
{
    /**
     * Handle any logic.
     * @param array $data
     * 
    */
    protected function handle(array $data)
    {
        $inputs   = $data['inputs'];
        $todoList = $data['todo'];
        $todoList->update($inputs);
        return $todoList->fresh();
    }
}