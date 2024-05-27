<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserLoginController extends Controller
{
    
    public function __invoke(UserLoginRequest $request)
    {
        $data = $request->validated();
        $user = User::whereEmail($data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response()->json(['User email or password not valid.'], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('user:api');
        return response()->json(['token' => $token->plainTextToken, 'user' => new UserResource($user)]);
    }
}
