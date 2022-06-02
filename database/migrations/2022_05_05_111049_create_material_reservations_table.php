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
        Schema::create('material_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->String('time');
            $table->String('date');
            $table->string('goal');
            $table->integer('id_material')->unsigned();
            $table->integer('id_user')->unsigned(); //  $table->integer('id_classroom')->unsigned()->after('id_classroom');
              $table->timestamps();
        });
        Schema::table('material_reservations', function($table)
        {
            $table->foreign('id_material')
                ->references('id')->on('material')
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
        Schema::dropIfExists('material_reservations');
    }
};
