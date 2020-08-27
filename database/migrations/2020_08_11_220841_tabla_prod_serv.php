<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaProdServ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('prod_serv', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('status');
            $table->string('codigo', 45);
            $table->string('nombre', 45);
            $table->string('descripcion', 45);
            $table->decimal('monto', 10, 2); 
            $table->smallInteger('tipo_monto');
            $table->string('clave_sat', 45)->nullable();
            $table->string('clave_producto', 45)->nullable();
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
        Schema::dropIfExists('prod_serv');
    }
}
