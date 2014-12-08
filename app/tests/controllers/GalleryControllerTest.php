<?php

class GalleryControllerTest extends TestCase {

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('GalleryTableSeeder');
    }

    public function testIndex()
    {
        $this->call('GET', 'v1.0/gallery');
        $this->assertResponseOk();
    }

    public function testShowSuccess()
    {
        $this->call('GET', 'v1.0/gallery/test');
        $this->assertResponseOk();
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testShowFail()
    {
        $this->call('GET', 'v1.0/gallery/not-found');
        $this->assertResponseStatus(Status::HTTP_NOT_FOUND);
    }

    public function testStoreSuccess()
    {
        $this->call('POST', 'v1.0/gallery', array(
            'title' => 'My World',
            'slug' => 'my-world',
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException ValidationException
     */
    public function testStoreFail()
    {
        $this->call('POST', 'v1.0/gallery', array(
            'slug' => 'my-world-two',
        ));
    }

    public function testUpdateSuccess()
    {
        $this->call('PATCH', 'v1.0/gallery/1', array(
            'title' => 'Hello World',
            'slug' => 'hello-world',
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException ValidationException
     */
    public function testUpdateFailValidation()
    {
        $this->call('PATCH', 'v1.0/gallery/1', array(
            'title' => 'Hello World',
        ));
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testUpdateFailNotFound()
    {
        $this->call('PATCH', 'v1.0/gallery/99');
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'v1.0/gallery/1');
        $this->assertResponseOk();
    }
}
