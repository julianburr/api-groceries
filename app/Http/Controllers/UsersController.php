<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Response;

class UsersController extends ApiController
{
    public function index () {
      return Response::json([
        'data' => User::all()
      ], 200);
    }
}
