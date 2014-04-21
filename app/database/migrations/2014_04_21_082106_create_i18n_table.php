<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateI18nTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i18n', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key', 100);
			$table->text('content');
			$table->enum('language', array('lv', 'en', 'ru'));
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
		Schema::drop('i18n');
	}

}
