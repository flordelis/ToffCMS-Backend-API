<?php

class GalleryItemControllerTest extends TestCase
{
    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('GalleryTableSeeder');
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testUploadFailNotFoundGallery()
    {
        $this->call(
            'POST',
            'v1.0/gallery/item/upload',
            array(
            'id' => 1000,
            )
        );
    }

    public function testUploadSuccess()
    {
        $fp = fopen("app/tests/1x1.gif", "w");
        fwrite($fp, "GIF89a\x01\x00\x01\x00\x80\x00\x00\xFF\xFF", 15);
        fwrite($fp, "\xFF\x00\x00\x00\x21\xF9\x04\x01\x00\x00\x00\x00", 12);
        fwrite($fp, "\x2C\x00\x00\x00\x00\x01\x00\x01\x00\x00\x02\x02", 12);
        fwrite($fp, "\x44\x01\x00\x3B", 4);
        fclose($fp);

        $uploadedFile = new \Symfony\Component\HttpFoundation\File\UploadedFile(
            'app/tests/1x1.gif',
            '1x1.gif'
        );

        $this->call(
            'POST',
            'v1.0/gallery/item/upload',
            array(
            'id' => 1,
            ),
            array(
            'file' => $uploadedFile,
            )
        );
    }

    public function testDestroy()
    {
        // Create new dummy images
        $img = imagecreate(1, 1);
        imagecolorallocate($img, 0, 0, 255);
        imagepng($img, Config::get('assets.images.paths.input') . 'test.png');

        if (!File::isDirectory(Config::get('assets.images.paths.output'))) {
            File::makeDirectory(Config::get('assets.images.paths.output'));
        }

        $img = imagecreate(1, 1);
        imagecolorallocate($img, 0, 0, 255);
        imagepng($img, Config::get('assets.images.paths.output') . 'small_test.png');

        // Create an actual gallery item
        $item = GalleryItem::create(
            array(
            'type' => 'image',
            'content' => 'test.png',
            'gallery_id' => 1
            )
        );

        // Delete this item
        $this->call('DELETE', 'v1.0/gallery/item/' . $item->id);
        $this->assertResponseOk();
    }

    public function testSaveOrder()
    {
        $this->call(
            'PUT',
            'v1.0/gallery/item/order',
            array(
            'data' => array(
                array('id' => 3),
                array('id' => 2),
                array('id' => 1),
            ),
            )
        );
        $this->assertResponseOk();
    }
}
