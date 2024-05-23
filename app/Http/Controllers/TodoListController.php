<?php

namespace App\Http\Controllers;

use App\Actions\TodoList\TodoListCreateAction;
use App\Actions\TodoList\TodoListDeleteAction;
use App\Actions\TodoList\TodoListUpdateAction;
use App\Http\Requests\Todolist\TodolistRequest;
use App\Models\TodoList;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        return response()->json($lists);   
    }

    public function show(TodoList $todo_list)
    {
        return response()->json($todo_list);
    }

    public function store(TodolistRequest $request, TodoListCreateAction $createAction)
    {
        return response()->json($createAction->run($request->validated()), Response::HTTP_CREATED);
    }

    public function update(TodoList $todo_list, TodolistRequest $request, TodoListUpdateAction $updateAction)
    {
        return response()->json($updateAction->run(['inputs' => $request->validated(), 'todo' => $todo_list]), Response::HTTP_OK);
    }

    public function destroy(TodoList $todo_list, TodoListDeleteAction $deleteAction)
    {
        $deleteAction->run(['todo' => $todo_list]);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
