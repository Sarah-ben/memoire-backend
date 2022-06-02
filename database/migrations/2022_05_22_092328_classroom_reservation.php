<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resevations', function (Blueprint $table) {
            $table->increments('id');
            $table->String('time');
            $table->String('date');
            $table->string('goal');
            $table->string('etat');
            //$table->dateTime('gig_startdate');
            $table->integer('id_classroom')->unsigned();
            $table->integer('id_user')->unsigned(); //  $table->integer('id_classroom')->unsigned()->after('id_classroom');
           // $table->foreign('id_classroom')->references('id_classroom')->on('classroom');
           // $table->unsignedBigInteger('id_user');
           // $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
        Schema::table('resevations', function($table)
{
    $table->foreign('id_classroom')
        ->references('id')->on('classroom')
        ->onDelete('cascade');

    $table->foreign('id_user')
        ->references('id')->on('users')
        ->onDelete('cascade');
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
};
