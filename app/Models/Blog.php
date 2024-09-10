<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $appends = ['thumb'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id')->withDefault();
    }

    public function getThumbAttribute()
    {
        return imageRecover($this->thumbnail);
    }
}
