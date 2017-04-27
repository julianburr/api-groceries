<?php

namespace App\Http\Controllers;

use App\ItemList;
use App\Transformers\ListTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListsController extends ApiController
{
    protected $listTransformer;
    public function __construct(ListTransformer $listTransformer)
    {
        $this->listTransformer = $listTransformer;
    }

    public function index()
    {
        // Get all list ids for current user from
        //  the pivot table
        $listIds = DB::table('list_user')
            ->where('user_id', '=', Auth::id())
            ->get()
            ->map(function ($item) {
                return $item->item_list_id;
            })
            ->all();

        // Then get the lists with these ids
        $lists = ItemList::with(['owner', 'users'])
            ->find($listIds)
            ->toArray();

        if (count($lists)) {
            $lists = $this->listTransformer->transformCollection($lists);
            return $this->respondWithData($lists);
        }
        return $this->respondNotFound('No lists found');
    }

    public function show($id)
    {
        $list = ItemList::with(['owner', 'users', 'items.category'])
            ->find($id)
            ->toArray();

        $userIds = array_map(function ($user) {
            return $user['id'];
        }, $list['users']);

        if ($list) {
            if (in_array(Auth::id(), $userIds)) {
                $list = $this->listTransformer->transformWithItems($list);
                return $this->respondWithData($list);
            }
            return $this->respondUnauthorized();
        }
        return $this->respondNotFound('List not found');
    }
}
