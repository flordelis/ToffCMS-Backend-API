<?php

class GalleryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('gallery')->delete();
        DB::table('GalleryItems')->delete();

        Gallery::create(array(
            'title' => 'Test',
            'slug' => 'test',
            'status' => 'live'
        ));

        Gallery::create(array(
            'title' => 'Test 2',
            'slug' => 'test-2',
            'status' => 'live'
        ));

        GalleryItem::create(array(
            'type' => 'video',
            'content' => 'test',
            'gallery_id' => 1
        ));
    }
}
