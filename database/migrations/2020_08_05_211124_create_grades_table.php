<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->integer('materia_id');
            $table->integer('grado');
            $table->float('periodo_1');
            $table->float('periodo_2');
            $table->float('periodo_3');
            $table->float('periodo_4');
            $table->float('periodo_5');
            $table->float('periodo_6');
            $table->float('periodo_extraordinario');
            $table->float('final');
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
        Schema::dropIfExists('grades');
    }
}
