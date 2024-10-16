<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone', 'address'];
    protected $table = 'suppliers';
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
