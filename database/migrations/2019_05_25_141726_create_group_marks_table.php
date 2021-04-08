<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_mark', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal("mark");
            $table->bigInteger("group_id")->unsigned();
            $table->bigInteger("evaluation_id")->unsigned();
            $table->foreign("group_id")->references("id")->on("group")->onDelete("cascade");
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
        Schema::dropIfExists('group_mark');
    }
}
