<?php

namespace App\Transformers;

class UserTransformer extends Transformer {

  public function transform ($user) {
    return [
      "id" => $user['id'],
      "email" => $user['email'],
      "name" => $user['name']
    ];
  }

}