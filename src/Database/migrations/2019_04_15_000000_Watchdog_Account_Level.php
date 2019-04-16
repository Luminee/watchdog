<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WatchdogAccountLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchdog_account_level', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('label');
            $table->integer('account_id');
            $table->integer('parent_id');
            $table->boolean('is_active');
            $table->decimal('sort', 15, 8);
            $table->timestamps();

            $table->index('account_id');
            $table->index('parent_id');
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
