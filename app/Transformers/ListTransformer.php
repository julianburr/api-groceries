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

    public function transformWithItems ($list) {
        $userTransformer = new UserTransformer();
        $itemTransformer = new ItemTransformer();

        $users = $userTransformer->transformCollection($list['users']);
        $owner = $userTransformer->transform($list['owner']);
        $items = $itemTransformer->transformCollection($list['items']);

        return [
            "id" => $list['id'],
            "name" => $list['name'],
            "desc" => $list['desc'],
            "owner" => $owner,
            "users" => $users,
            "items" => $items
        ];
    }
}
