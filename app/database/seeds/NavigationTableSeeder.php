<?php

class NavigationTableSeeder extends Seeder {

	protected $languages = array(
		'lv',
		'en',
		'ru',
	);

	public function run()
	{
		DB::table('navigation')->delete();

		foreach ($this->languages as $lang)
		{
			$page = Page::where('language', $lang)->first();

			if ($page === NULL)
			{
				continue;
			}

			Navigation::create(array(
				'title' => 'Home (' . $lang . ')',
				'type' => 'uri',
				'uri' => '',
				'language' => $lang,
			));

			Navigation::create(array(
				'title' => $page->title . ' (' . $lang . ')',
				'type' => 'page',
				'page_id' => $page->id,
				'language' => $lang,
			));

			Navigation::create(array(
				'title' => 'Google (' . $lang . ')',
				'type' => 'website',
				'url' => 'http://www.google.com/',
				'language' => $lang,
			));

			Navigation::create(array(
				'title' => '404 (' . $lang . ')',
				'type' => 'uri',
				'url' => '/404',
				'language' => $lang,
			));
		}



	}

}
