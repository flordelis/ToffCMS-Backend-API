<?php

class FilterTest extends TestCase {

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('UserTableSeeder');
    }

    public function testAuthFilterSuccess()
    {
        Route::enableFilters();
        $user = User::find(1);

        $this->call('GET', 'v1.0/user/1', array(
            'api_key' => $user->api_key,
            'user_id' => $user->id,
        ));

        $this->assertResponseOk();
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testAuthFilterFail()
    {
        Route::enableFilters();
        $this->call('GET', 'v1.0/user/1');
    }

}
