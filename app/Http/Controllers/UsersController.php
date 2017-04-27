<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UsersController extends ApiController
{
    protected $userTransformer;
    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function auth(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('web')->once(['email' => $email, 'password' => $password])) {
            $user = Auth::guard('web')->user();
            return $this->respondApiToken($user->api_token);
        }
        return $this->respondInvalidInpit('User not found');
    }

    public function me()
    {
        $me = Auth::user();
        if ($me) {
            $me = $this->userTransformer->transform($me);
            return $this->respondWithData($me);
        }
        return $this->respondUnauthorized();
    }

    public function index()
    {
        $users = User::all();
        $users = $this->userTransformer->transformCollection($users->all());
        return $this->respondWithData($users);
    }

    public function show($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user = $this->userTransformer->transform($user);
            return $this->respondWithData($user);
        }
        return $this->respondNotFound('No contact found');
    }
}
