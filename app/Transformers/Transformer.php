<?php

namespace App\Transformers;

abstract class Transformer
{
    public function transformCollection(array $collection)
    {
        return array_map([$this, 'transform'], $collection);
    }

    abstract public function transform($item);
}
