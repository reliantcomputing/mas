<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubSubRubric;
use App\SubRubric;

class SubSubRubric extends Model
{
    protected $table = "sub_sub_rubric";


    public function subRubric()
    {
        return SubRubric::where("id", $this->sub_rubric_id)->orderBy("created_at", "ASC")->first();
    }
}
