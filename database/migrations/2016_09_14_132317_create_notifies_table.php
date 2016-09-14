<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from')->unsigned()->index();
            $table->string('ip_address',32);
            $table->string('type',64);
            $table->integer('type_id')->unsigned();
            $table->text('body');
            $table->boolean('new')->default(true);
            $table->integer('to')->unsigned()->index();
            $table->timestamps();

            $table->foreign('from')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifies');
    }
}
