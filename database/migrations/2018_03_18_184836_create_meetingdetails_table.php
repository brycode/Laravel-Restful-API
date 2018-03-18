<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetingdetails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('meeting_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('meeting_id')->references('id')->on('meetings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetingdetails');
    }
}
