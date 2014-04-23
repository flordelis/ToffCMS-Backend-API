<?php

class SettingTableSeeder extends Seeder {

	public function run()
	{
		DB::table('settings')->delete();

		Setting::create(array(
			'name' => 'Site name',
			'key' => 'siteName',
			'default' => 'My Website',
			'is_public' => 'Y'
		));

		Setting::create(array(
			'name' => 'Default Language',
			'key' => 'defaultLanguage',
			'default' => 'en',
			'available_values' => 'en|lv|ru',
			'is_public' => 'Y'
		));

	}

}
