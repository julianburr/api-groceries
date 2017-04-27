<?php

namespace App\Transformers;

class ItemTransformer extends Transformer
{
    public function transform($item)
    {
        return [
            "id" => $item['id'],
            // "category" => $item['category'],
            "name" => $item['name']
        ];
    }
}
