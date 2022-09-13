<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PublishType;

class Channel extends Model
{
    protected $fillable = [
        'title',
        'publish_type',
        'publised_at',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopePublished($query)
    {
        return $query->where('publish_type', PublishType::PUBLISHED);
    }

    public function format_date()
    {
        $date = new \DateTime($this->updated_at);
        return $date->format('M j Y G:i:s +900');
    }

    public function draft()
    {
        return $this->publish_type == PublishType::DRAFT;
    }

    public function to_draft()
    {
        $this->publish_type = PublishType::DRAFT;
    }

    public function to_publish()
    {
        $this->publish_type = PublishType::PUBLISHED;
    }

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('order_number', 'asc');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}