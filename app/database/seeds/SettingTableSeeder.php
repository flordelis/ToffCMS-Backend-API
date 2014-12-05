<?php

class SettingTableSeeder extends Seeder {

	public function run()
	{
		DB::table('settings')->delete();

		BackendSetting::create(array(
			'name' => 'Site name',
			'key' => 'siteName',
			'default' => 'My Website',
			'is_public' => 'Y'
		));

		BackendSetting::create(array(
			'name' => 'Default Language',
			'key' => 'defaultLanguage',
			'default' => 'en',
			'available_values' => 'en|lv|ru',
			'is_public' => 'Y'
		));

	}

}
