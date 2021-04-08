<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_mark', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal("mark");
            $table->bigInteger("evaluation_id")->unsigned();
            $table->string("student_number");
            $table->foreign("evaluation_id")->references("id")->on("evaluation")->onDelete("cascade");
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
        Schema::dropIfExists('student_mark');
    }
}
