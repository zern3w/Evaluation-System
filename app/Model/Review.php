<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = [
      'user_id', 'reviewer_id', 'rating', 'comment'
  ];

    public function getDayagoAttribute($query)
    {
        $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffInDays();
        return $date;
    }
}
