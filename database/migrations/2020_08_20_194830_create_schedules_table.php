<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materia_id');
            $table->bigInteger('group_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('status');
            $table->smallInteger('day');
            $table->smallInteger('hour');
            $table->smallInteger('slot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schedule');
    }

}
