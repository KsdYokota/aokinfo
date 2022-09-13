<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    public function items()
    {
        return $this->belongsToMany('App\Item', 'feed_items');
    }
}
