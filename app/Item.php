<?php

namespace App;

use App\Enums\ItemType;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'title',
        'date',
    ];

    protected $enumCasts = [
        'item_type' => ItemType::class,
    ];

    public function format_date()
    {
        $date = new \DateTime($this->date);
        return $date->format('M j Y G:i:s +900');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    
    public function feeds()
    {
        return $this->belongsToMany('App\Feed', 'feed_items');
    }

    public function scopeNormal($query)
    {
        return $query->where('item_type', ItemType::NORMAL);
    }
    public function scopeUserSupport($query)
    {
        return $query->where('item_type', ItemType::USER_SUPPORT);
    }
    
    public function scopeYosakoi($query)
    {
        return $query->where('item_type', ItemType::YOSAKOI);
    }
}
