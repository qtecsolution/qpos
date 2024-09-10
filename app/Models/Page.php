<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $appends = ['thumb', 'thumb_null'];

    public function getThumbAttribute()
    {
        return imageRecover($this->thumbnail);
    }

    public function getThumbNullAttribute()
    {
        return imageRecoverNull($this->thumbnail);
    }
}
