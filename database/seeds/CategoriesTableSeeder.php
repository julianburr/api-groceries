<?php

use App\Category;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
          $user = User::inRandomOrder()->first();
          Category::create([
            "name" => $faker->word,
            "color" => "#dd21ac",
          ]);
        }
    }
}
