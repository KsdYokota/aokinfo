<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    
    protected $fillable = [
        'channel_id',
        'content',
        'sid',
    ];
    
    //
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'DESC')->get();
    }
}