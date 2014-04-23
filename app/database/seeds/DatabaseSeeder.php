<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('PageTableSeeder');
		$this->call('GalleryTableSeeder');
		$this->call('I18nTableSeeder');
		$this->call('NavigationTableSeeder');
		$this->call('SettingTableSeeder');
	}

}
