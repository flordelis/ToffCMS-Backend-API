<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pages',
            function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('title', 100);
                $table->string('slug', 100)->unique();
                $table->text('body');
                $table->enum('status', array('live', 'draft'))->default('draft');
                $table->enum('language', array('en', 'lv', 'ru'))->default('en');
                $table->integer('author_id');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
