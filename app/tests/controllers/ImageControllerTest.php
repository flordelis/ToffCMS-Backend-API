<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageControllerTest extends TestCase
{

    protected static $filename = 'example.png';
    protected static $path = 'app/tests/';

    public function setUp()
    {
        parent::setUp();

        $my_img = imagecreate(200, 200);
        imagecolorallocate($my_img, 0, 0, 255);
        imagepng($my_img, static::$path . static::$filename);

        $file = new \Symfony\Component\HttpFoundation\File\File(static::$path . static::$filename);
        $file->move(Config::get('assets.images.paths.input'), static::$filename);
    }

    public function tearDown()
    {
        parent::tearDown();
        unlink(Config::get('assets.images.paths.input') . static::$filename);
    }

    /**
     * @expectedException \Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException
     */
    public function testOriginalNotFound()
    {
        $this->call('GET', 'image/not-found.jpg');
    }

    public function testOriginalSuccess()
    {
        $this->call('GET', 'image/' . static::$filename);
        $this->assertResponseOk();
    }

    /**
     * @expectedException \Imagine\Exception\InvalidArgumentException
     */
    public function testResizeNotFound()
    {
        $this->call('GET', 'image/small/not-found.jpg');
    }

    public function testResizeSuccess()
    {
        $this->call('GET', 'image/small/' . static::$filename);
        $this->assertResponseOk();

        $this->client->restart();

        $this->call('GET', 'image/small/' . static::$filename);
        $this->assertResponseOk();

        // Delete the image
        unlink(Config::get('assets.images.paths.output') . 'small_' . static::$filename);
    }
}
