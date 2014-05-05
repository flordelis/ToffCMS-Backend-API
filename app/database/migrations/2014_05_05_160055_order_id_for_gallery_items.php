<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderIdForGalleryItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_items', function(Blueprint $table)
		{
			$table->integer('order_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gallery_items', function(Blueprint $table)
		{
			$table->dropColumn('order_id');
		});
	}

}
