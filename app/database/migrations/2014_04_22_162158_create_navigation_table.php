<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'navigation',
            function(Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->enum('type', array('page', 'website', 'uri'));
                $table->string('uri')->nullable();
                $table->string('url')->nullable();
                $table->integer('page_id')->nullable();
                $table->integer('order_id')->nullable();
                $table->enum('language', array('lv', 'en', 'ru'));
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
        Schema::drop('navigation');
    }
}
