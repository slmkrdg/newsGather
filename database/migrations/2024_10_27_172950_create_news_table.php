<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned();  
            $table->text('title');
            $table->timestamp('published_at');
            $table->string('driver')->nullable(); 
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
}
