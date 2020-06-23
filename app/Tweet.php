<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Tweet extends Model
{
  use SoftDeletes;
  
  public function getFollowCount($user_id)
  {
      return $this->where('follow_id', $user_id)->count();
  }

  public function getFollowerCount($user_id)
  {
      return $this->where('follower_id', $user_id)->count();
  }
}
