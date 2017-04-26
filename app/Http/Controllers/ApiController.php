<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $statusCode = 200;

    public function getStatusCode () {
      return $this->statusCode;
    }

    public function setStatusCode ($code) {
      $this->statusCode = $code;
      return $this;
    }

    public function respond ($data, $headers = []) {
      return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithData ($data) {
      return $this->setStatusCode(200)->respond([
        'data' => $data
      ]);
    }

    public function respondWithError ($message) {
      return $this->setStatusCode(404)->respond([
        'error' => [
          'message' => $message
        ]
      ]);
    }

    public function respondNotFound ($message = 'Resource not found') {
      return $this->respondWithError($message);
    }
}
