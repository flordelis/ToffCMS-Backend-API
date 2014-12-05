<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetPageDefaultColumnValues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		return;
		$page = new Page();
		die($page->getTable());
		DB::statement("ALTER TABLE `hm_pages` CHANGE COLUMN `status` `status` ENUM('live', 'draft') NOT NULL DEFAULT 'draft';");
		DB::statement("ALTER TABLE `pages` CHANGE COLUMN `language` `language` ENUM('en', 'lv', 'ru') NOT NULL DEFAULT 'en';");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// DB::statement("ALTER TABLE `pages` CHANGE COLUMN `status` `status` ENUM('live', 'draft') NOT NULL DEFAULT '';");
		// DB::statement("ALTER TABLE `pages` CHANGE COLUMN `language` `language` ENUM('en', 'lv', 'ru') NOT NULL DEFAULT '';");
	}

}
