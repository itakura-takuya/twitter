<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = [
        'follow_id',
        'follower_id'
    ];
    protected $fillable = [
        'follow_id',
        'follower_id'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
