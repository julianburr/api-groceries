<?php

use App\Category;
use App\Item;
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
        DB::table('list_item')->delete();
        DB::table('list_user')->delete();

        User::truncate();
        ItemList::truncate();
        Category::truncate();
        Item::truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(ItemListsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ListItemTableSeeder::class);
        $this->call(ListUserTableSeeder::class);
    }
}
