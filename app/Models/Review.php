<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'yandex_review_id',
        'organisation_id',
        'name',
        'text',
        'rating',
        'date',
    ];

    public function organisation(){
        return $this->belongsTo(Organisation::class);
    }
}
