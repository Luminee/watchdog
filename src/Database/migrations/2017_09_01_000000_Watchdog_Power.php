<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WatchdogPower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchdog_power', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('group_id');
            $table->string('action');
            $table->string('label');
            $table->string('route');
            $table->decimal('sort', 15, 8);
            $table->timestamps();

            $table->index('group_id');
            $table->unique('action');
            $table->unique('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
