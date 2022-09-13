<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'channel_id',
        'title',
        'order_number',
        'content'
    ];
    
    //
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function scopeOrder($query)
    {
        return $query->where('order_number', "ASC");
    }
}