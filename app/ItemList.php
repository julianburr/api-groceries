<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'owner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function owner () {
        return $this->belongsTo('App\User', 'owner');
    }

    public function items () {
        return $this->belongsToMany('App\Item', 'list_item');
    }

    public function users () {
        return $this->belongsToMany('App\User', 'list_user');
    }
}
