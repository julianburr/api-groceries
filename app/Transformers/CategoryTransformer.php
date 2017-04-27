<?php

namespace App\Transformers;

class CategoryTransformer extends Transformer
{
    public function transform($cat)
    {
        return [
            "id" => $cat['id'],
            "color" => $cat['color'],
            "name" => $cat['name']
        ];
    }
}
