<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->unsignedInteger('news_id')->nullable();
            $table->timestamps();

            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
