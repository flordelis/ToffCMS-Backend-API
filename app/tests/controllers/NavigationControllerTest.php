<?php

class NavigationControllerTest extends TestCase {

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('NavigationTableSeeder');
    }

    public function testIndex()
    {
        $this->call('GET', 'v1.0/navigation');
        $this->assertResponseOk();
    }

    public function testSaveOrderSuccess()
    {
        $this->call('PUT', 'v1.0/navigation/order', array(
            'data' => array(
                array('id' => 3),
                array('id' => 2, 'children' => array(
                    array('id' => 5),
                    array('id' => 4),
                )),
                array('id' => 1),
            ),
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSaveOrderFail()
    {
        $this->call('PUT', 'v1.0/navigation/order', array(
            'data' => array(
                array('id' => 3),
                array('children' => array(
                    array('id' => 5),
                )),
            ),
        ));
    }

    public function testShow()
    {
        $this->call('GET', 'v1.0/navigation/en');
        $this->assertResponseOk();
    }

    public function testStoreSuccess()
    {
        $this->call('POST', 'v1.0/navigation', array(
            'title' => 'Hello World',
            'type' => 'website',
            'language' => 'en',
            'url' => 'http://google.com/',
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException ValidationException
     */
    public function testStoreFail()
    {
        $this->call('POST', 'v1.0/navigation', array(
            'type' => 'website',
            'language' => 'en',
        ));
    }

    public function testUpdateSuccess()
    {
        $this->call('PATCH', 'v1.0/navigation/1', array(
            'title' => 'Hello World',
            'type' => 'website',
            'language' => 'en',
        ));
        $this->assertResponseOk();
    }

    /**
     * @expectedException ValidationException
     */
    public function testUpdateFailValidation()
    {
        $this->call('PATCH', 'v1.0/navigation/1', array(
            'type' => 'website',
            'language' => 'en',
        ));
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testUpdateFailNotFound()
    {
        $this->call('PATCH', 'v1.0/navigation/99');
    }

    public function testDestroy()
    {
        $this->call('DELETE', 'v1.0/navigation/1');
        $this->assertResponseOk();
    }
}
