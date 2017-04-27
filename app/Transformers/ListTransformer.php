<?php

namespace App\Transformers;

use App\Transformers\UserTransformer;

class ListTransformer extends Transformer
{
    public function transform($list)
    {
        $userTransformer = new UserTransformer();
        $users = $userTransformer->transformCollection($list['users']);
        $owner = $userTransformer->transform($list['owner']);

        return [
            "id" => $list['id'],
            "name" => $list['name'],
            "desc" => $list['desc'],
            "owner" => $owner,
            "users" => $users
        ];
    }
}
