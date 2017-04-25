<?php

use App\ItemList;
use App\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        ItemList::truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(ItemListsTableSeeder::class);
    }
}
