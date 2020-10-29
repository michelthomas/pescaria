<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePescadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pescados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pescaria_id');
            $table->string('name');
            $table->float('weight');
            $table->integer('size');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('pescaria_id')
                ->references('id')
                ->on('pescarias')
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
        Schema::dropIfExists('pescados');
    }
}
