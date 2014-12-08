<?php

class GalleryItemTest extends TestCase {

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('GalleryTableSeeder');
    }

    public function testGallery()
    {
        $item = Gallery_Item::find(1);
        $this->assertSame($item->gallery->id, Gallery::find(1)->id);
    }
}
