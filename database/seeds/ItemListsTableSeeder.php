<?php

use App\ItemList;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ItemListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $user = User::inRandomOrder()->first();

            ItemList::create([
                "name" => $faker->word,
                "desc" => $faker->paragraph,
                "owner" => $user->id
            ]);
        }
    }
}
