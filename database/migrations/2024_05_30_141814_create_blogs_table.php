<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->integer('category');
            $table->longText('short_desp')->nullable();
            $table->longText('long_desp');
            $table->string('imageAlt')->default('default');
            $table->string('image')->default('default.jpg');
            $table->date('date');
            $table->integer('type');
            $table->date('publishDate')->nullable();
            $table->string('slug')->unique();
            $table->integer('addedBy');
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
