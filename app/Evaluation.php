<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = "evaluation";

    public function rubrics()
    {
        return Rubric::where("evaluation_id", $this->id)->orderBy("created_at", "ASC")->get();
    }
}
