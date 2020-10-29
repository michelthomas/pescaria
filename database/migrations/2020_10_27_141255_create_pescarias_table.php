<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePescariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pescarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('open');
            $table->date('date');
            $table->time('hour');
            $table->string('place');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


        });

        Schema::create('participantes', function (Blueprint $table) {
            $table->primary(['pescaria_id', 'user_id']);
            $table->foreignId('pescaria_id');
            $table->foreignId('user_id');

            $table->foreign('pescaria_id')
                ->references('id')
                ->on('pescarias')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('participantes');
        Schema::dropIfExists('pescarias');

    }
}
