<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMark extends Model
{
    protected $table = "group_mark";

    public function evaluation()
    {
        return $this->belongsTo('App\Evaluation');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
