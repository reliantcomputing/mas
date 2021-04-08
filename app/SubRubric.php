<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rubric;
use App\SubSubRubric;
class SubRubric extends Model
{
    protected $table = "sub_rubric";

    public function subSubRubrics()
    {
        return SubSubRubric::where("sub_rubric_id", $this->id)->get();
    }

    public function rubric()
    {
        return Rubric::where("id", $this->rubric_id)->orderBy("created_at", "ASC")->first();
    }
}
