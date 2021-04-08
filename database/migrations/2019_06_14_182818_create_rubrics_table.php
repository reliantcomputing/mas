<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("position")->default(0);
            $table->bigInteger("evaluation_id");
            $table->bigInteger("group_id")->nullable();
            $table->text("aspect_to_be_evaluated")->nullable();
            $table->text("details")->nullable();
            $table->double("total_mark");
            $table->double("learner_mark")->nullable();
            $table->text("comments")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric');
    }
}
