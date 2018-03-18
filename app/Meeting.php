<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = 'id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function meetingdetails()
    {
        return $this->hasMany('App\Meetingdetail');
    }
}
