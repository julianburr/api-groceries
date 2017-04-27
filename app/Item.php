<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'created_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function lists()
    {
        return $this->belongsToMany('App\ItemList', 'list_item');
    }
}
