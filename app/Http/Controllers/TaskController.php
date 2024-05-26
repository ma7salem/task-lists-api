<?php

namespace App\Http\Controllers;

use App\Actions\Task\TaskCreateAction;
use App\Actions\Task\TaskDeleteAction;
use App\Actions\Task\TaskUpdateAction;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    
    public function index(TodoList $list) 
    {
        $tasks = $list->tasks;
        return response()->json($tasks);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function store(TodoList $list, TaskRequest $request, TaskCreateAction $createAction)
    {
        return response()->json($createAction->run(['inputs' => $request->validated(), 'todo' => $list]), Response::HTTP_CREATED);
    }

    public function update(Task $task, TaskRequest $request, TaskUpdateAction $updateAction)
    {
        return response()->json($updateAction->run(['inputs' => $request->validated(), 'task' => $task]));
    }

    public function destroy(Task $task, TaskDeleteAction $deleteAction)
    {
        $deleteAction->run(['task' => $task]);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
