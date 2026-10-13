<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'yandex_id',
        'name',
        'category_id',
        'address',
        'rating_value',
        'rating_count',
        'review_count',

    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
