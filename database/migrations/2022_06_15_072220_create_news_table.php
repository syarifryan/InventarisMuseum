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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->text("content");
            $table->string("keyword");
            $table->string("category_id");
            $table->string("picture");
            // $table->unsignedBigInteger("language_id");
            // $table->foreign('language_id')->references('id')->on('languages');
            $table->tinyInteger("status")->default(1)->comment("1: Active, 2: Nonactive");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
