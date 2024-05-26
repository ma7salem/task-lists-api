<?php

namespace App\Http\Controllers;

use App\Actions\Label\LabelCreateAction;
use App\Actions\Label\LabelDeleteAction;
use App\Actions\Label\LabelUpdateAction;
use App\Http\Requests\Label\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LabelController extends Controller
{
    public function index()
    {
        return response()->json(auth()->user()->labels);
    }

    public function show(Label $label)
    {
        return response()->json($label);    
    }

    public function store(LabelRequest $request, LabelCreateAction $createAction)
    {
        return response()->json($createAction->run($request->validated()), Response::HTTP_CREATED);
    }

    public function update(Label $label, LabelRequest $request, LabelUpdateAction $updateAction)
    {
        return response()->json($updateAction->run(['inputs' => $request->validated(), 'label' => $label]));
    }

    public function destroy(Label $label, LabelDeleteAction $deleteAction)
    {
        return response()->json($deleteAction->run(['label' => $label]), Response::HTTP_NO_CONTENT);
    }
}
