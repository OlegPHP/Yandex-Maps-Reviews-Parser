<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation;

class Category extends Model
{
    protected $fillable = [
        'name',
            ];
    public function organisations(){
        return $this->hasMany(Organisation::class);
    }


}
