<?php

namespace App\Transformers;

use App\Transformers\CategoryTransformer;

class ItemTransformer extends Transformer
{
    public function transform($item)
    {
        $categoryTransformer = new CategoryTransformer();
        return [
            "id" => $item['id'],
            "category" => $categoryTransformer->transform($item['category']),
            "name" => $item['name']
        ];
    }
}
