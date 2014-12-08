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

        $i = 0;

        foreach ($this->languages as $lang)
        {
            $page = Page::where('language', $lang)->first();

            $parent = Navigation::create(array(
                'title' => 'Home (' . $lang . ')',
                'type' => 'uri',
                'uri' => '',
                'language' => $lang,
                'order_id' => ++$i
            ));

            if ($page)
            {
                Navigation::create(array(
                    'title' => $page->title . ' (' . $lang . ')',
                    'type' => 'page',
                    'page_id' => $page->id,
                    'language' => $lang,
                    'order_id' => ++$i
                ));
            }

            Navigation::create(array(
                'title' => 'Google (' . $lang . ')',
                'type' => 'website',
                'target' => '_blank',
                'url' => 'http://www.google.com/',
                'language' => $lang,
                'order_id' => ++$i
            ));

            Navigation::create(array(
                'title' => '404 (' . $lang . ')',
                'type' => 'uri',
                'uri' => '/404',
                'language' => $lang,
                'order_id' => ++$i
            ));

            for ($j = 1; $j <= rand(2, 6); $j++)
            {
                Navigation::create(array(
                    'title' => 'Item #' . $j,
                    'type' => 'uri',
                    'uri' => '',
                    'language' => $lang,
                    'order_id' => ++$i,
                    'parent_id' => $parent->id,
                ));
            }
        }



    }

}
