<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetingdetail extends Model
{
    protected $guarded = 'id';

    public function meeting()
    {
        return $this->belongsTo('App\Meeting', 'meeting_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
