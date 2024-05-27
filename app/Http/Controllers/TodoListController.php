<?php

namespace App\Http\Controllers;

use App\Actions\TodoList\TodoListCreateAction;
use App\Actions\TodoList\TodoListDeleteAction;
use App\Actions\TodoList\TodoListUpdateAction;
use App\Http\Requests\Todolist\TodolistRequest;
use App\Http\Resources\TodoList\TodoListResource;
use App\Models\TodoList;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index()
    {
        return response()->json(TodoListResource::collection(auth()->user()->todoLists()->paginate()) );   
    }

    public function show(TodoList $list)
    {
        return response()->json(new TodoListResource($list));
    }

    public function store(TodolistRequest $request, TodoListCreateAction $createAction)
    {
        return response()->json(new TodoListResource($createAction->run($request->validated())), Response::HTTP_CREATED);
    }

    public function update(TodoList $list, TodolistRequest $request, TodoListUpdateAction $updateAction)
    {
        return response()->json(new TodoListResource($updateAction->run(['inputs' => $request->validated(), 'todo' => $list])), Response::HTTP_OK);
    }

    public function destroy(TodoList $list, TodoListDeleteAction $deleteAction)
    {
        return response()->json($deleteAction->run(['todo' => $list]), Response::HTTP_NO_CONTENT);
    }
}
