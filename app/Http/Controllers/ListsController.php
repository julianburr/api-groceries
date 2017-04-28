<?php

namespace App\Http\Controllers;

use App\User;
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

    public function store(Request $request)
    {
        if (!Auth::id()) {
            return $this->respondUnauthorized();
        }

        if (!$request->input('name')) {
            return $this->respondInvalidInput('Name has to be defined');
        }

        $list = new ItemList;
        $list->name = $request->input('name');
        $list->desc = $request->input('desc');
        $list->owner = Auth::id();
        $list->save();

        $list->users()->attach(Auth::user());

        $userIds = $request->input('userIds');
        foreach ($userIds as $userId) {
            if ($userId !== Auth::id()) {
                $user = User::find($userId);
                if ($user) {
                    $list->users()->attach($user);
                }
            }
        }

        return $this->show($list->id);
    }

    public function update($listId, Request $request)
    {
        $list = ItemList::with('users')->find($listId);
        if (!$list) {
            return $this->respondNotFound('List not found');
        }

        $userIds = array_map(function ($user) {
            return $user['id'];
        }, $list['users']->toArray());

        if (!in_array(Auth::id(), $userIds)) {
            return $this->respondUnauthorized();
        }

        if ($request->input('name')) {
            $list->name = $request->input('name');
        }

        if ($request->input('desc')) {
            $list->desc = $request->input('desc');
        }

        if ($request->input('userIds')) {
            $oldIds = $userIds;
            foreach ($oldIds as $oldId) {
                if (!in_array($oldId, $request->input('userIds')) && $oldId !== Auth::id()) {
                    $list->users()->detach($oldId);
                }
            }

            foreach ($request->input('userIds') as $newId) {
                if (!in_array($newId, $oldIds)) {
                    $list->users()->attach($newId);
                }
            }
        }

        $list->save();

        return $this->show($list->id);
    }
}
