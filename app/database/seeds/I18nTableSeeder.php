<?php

class I18nTableSeeder extends Seeder {

	public function run()
	{
		DB::table('i18n')->delete();

		I18n::create(array(
			'key' => 'test',
			'content' => 'This is my test string',
			'language' => 'en'
		));

		I18n::create(array(
			'key' => 'hello',
			'content' => 'Hello World',
			'language' => 'en'
		));

	}

}
