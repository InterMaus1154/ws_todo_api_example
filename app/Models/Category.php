<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /*
     * Define relationships
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
