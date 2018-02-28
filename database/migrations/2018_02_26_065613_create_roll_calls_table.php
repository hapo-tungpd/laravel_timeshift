<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateRollCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_calls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->date('roll_call_date');
            $table->integer('total_time');
            $table->softDeletes();
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
        Schema::dropIfExists('roll_calls');
    }
}
