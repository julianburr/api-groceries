<?php

use App\Category;
use App\Item;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $user = User::inRandomOrder()->first();
            $category = Category::inRandomOrder()->first();

            Item::create([
                "name" => $faker->word,
                "category_id" => $category->id,
                "created_by" => $user->id
            ]);
        }
    }
}
