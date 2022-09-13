<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Enums\PublishType;

class Message extends Model
{
    //
    //
    protected $fillable = [
        'title',
        'category',
        'type',
        'description',
        'published_at',
        'publish_type',
    ];

    //
    protected $attributes = [
        'category' => '',
        'title' => '',
        'type' => 'description',
        'description' => "",
    ];

    protected $enumCasts = [
        'publish_type' => PublishType::class,
    ];

    public function published_at_jp()
    {
        $date = \Carbon\Carbon::parse($this->published_at);
        return $date->format('Y年m月d日');
    }
    public function pubDate()
    {
        $date = \Carbon\Carbon::parse($this->published_at);
        return $date->format('Y-m-d');
    }

    public function draft()
    {
        return $this->publish_type == PublishType::DRAFT;
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('publish_type', PublishType::PUBLISHED);
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function truncate_description($limit = 100)
    {
        return Str::limit($this->description, $limit);
    }

}