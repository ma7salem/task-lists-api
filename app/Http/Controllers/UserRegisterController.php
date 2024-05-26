<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterController extends Controller
{
    
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json($user, Response::HTTP_CREATED);
    }
}
