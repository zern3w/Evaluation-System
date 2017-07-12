<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = "reviews";
  protected $fillable = [
      'user_id', 'reviewer_id', 'rating', 'comment'
  ];

}
