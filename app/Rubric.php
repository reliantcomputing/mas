<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SubRubric;
use App\Evaluation;
use App\Group;

class Rubric extends Model
{
    protected $table = "rubric";

    public function subRubrics()
    {
        return SubRubric::where("rubric_id", $this->id)->get();
    }

    public function evaluation()
    {
        return Evaluation::where("id", $this->evaluation_id)->first();
    }

    public function group()
    {
        return Group::where("id", $this->group_id)->orderBy("created_at", "ASC")->first();
    }
}
