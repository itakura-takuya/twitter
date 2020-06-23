<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = ['user_id', 'username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
