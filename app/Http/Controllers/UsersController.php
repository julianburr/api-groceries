<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Response;

class UsersController extends ApiController
{
    protected $userTransformer;

    function __construct (UserTransformer $userTransformer) {
      $this->userTransformer = $userTransformer;
    }

    public function index () {
      $users = User::all();
      $users = $this->userTransformer->transformCollection($users->all());
      return $this->respondWithData($users);
    }

    public function show ($userId) {
      $user = User::find($userId);

      if ($user) {
        $user = $this->userTransformer->transform($user);
        return $this->respondWithData($user);
      }
      return $this->respondNotFound('No contact found');
    }
}
