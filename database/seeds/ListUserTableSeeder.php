<?php

use App\ItemList;
use App\User;
use Illuminate\Database\Seeder;

class ListUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        ItemList::get()->map(function ($list) use ($users) {
            $i = 0;
            $used = [$list->owner];
            $list->users()->attach($list->owner);

            while ($i < rand(1, 2)) {
                if (count($users)) {
                    $user = $users[rand(0, count($users) - 1)]->id;
                    if (!in_array($user, $used)) {
                        $list->users()->attach($user);
                        $used[] = $user;
                    }
                }
                $i++;
            }
        });
    }
}
