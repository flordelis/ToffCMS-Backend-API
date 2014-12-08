<?php

class PageControllerTest extends TestCase {

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('UserTableSeeder');
        $this->seed('PageTableSeeder');
    }

    public function testIndex()
    {
        $this->call('GET', 'v1.0/page');
        $this->assertResponseOk();
    }

    public function testShow()
    {
        $this->call('GET', 'v1.0/page/test');
        $this->assertResponseOk();
    }

    public function testStoreSuccess()
    {
        $this->be(User::find(1));
        $this->call('POST', 'v1.0/page', array(
            'title' => 'Hello World',
            'slug' => 'hello-world',
            'body' => 'Lorem ipsum dolor sit amet',
        ));
        $this->assertResponseOk();
    }

    /**
     * Attempt to update without a slug field.
     * This should result in a validation error.
     * @expectedException ValidationException
     * @return void
     */
    public function testStoreFail()
    {
        $this->call('POST', 'v1.0/page', array(
            'title' => 'Hello World',
            'body' => 'Lorem ipsum dolor sit amet',
        ));
    }

    public function testUpdateSuccess()
    {
        $this->call('PATCH', 'v1.0/page/1', array(
            'title' => 'Hello World',
            'slug' => 'hello-world',
            'body' => 'Lorem ipsum dolor sit amet',
            'status' => 'live',
            'language' => 'en',
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException ValidationException
     */
    public function testUpdateFailValidation()
    {
        $this->call('PATCH', 'v1.0/page/1', array(
            'title' => 'Hello World',
            'body' => 'Lorem ipsum dolor sit amet',
            'status' => 'live',
            'language' => 'en',
        ));
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testUpdateFailNotFound()
    {
        $this->call('PATCH', 'v1.0/page/99');
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'v1.0/page/1');
        $this->assertResponseOk();
    }
}
