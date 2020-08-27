<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('user_info_invoice_id');
            $table->tinyInteger('status');
            $table->tinyInteger('type');
            $table->string('serie', 10);
            $table->string('inv_number', 32);
            $table->uuid('uuid')->unique();
            $table->decimal('total', 10, 2);
            $table->string('currency', 5);
            $table->string('method_pay', 5);
            $table->dateTime('date_invoice');
            $table->tinyInteger('check_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('invoice');
    }

}
