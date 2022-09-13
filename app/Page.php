<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    
    protected $fillable = [
        'title',
        'content',
    ];
    
    public function manual()
    {
        return $this->belongsTo('App\Manual');
    }    
}
