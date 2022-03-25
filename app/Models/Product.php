<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $appends = ['cost'];

    public function getCostAttribute()
    {
        return $this->price - ( ($this->price * $this->discount) / 100 );
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
