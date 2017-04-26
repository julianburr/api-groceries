<?php

use App\Item;
use App\ItemList;
use Illuminate\Database\Seeder;

class ListItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();

        ItemList::get()->map(function ($list) use ($items) {
          $i = 0;
          $used = [];

          while ($i < rand(2,5)) {
            if (count($items)) {
              $item = $items[rand(0, count($items) - 1)]->id;
              if (!in_array($item, $used)) {
                $list->items()->attach($item);
                $used[] = $item;
              }
            }
            $i++;
          }

        });
    }
}
