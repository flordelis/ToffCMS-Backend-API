<?php

class UserControllerTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('UserTableSeeder');
	}

	public function testShow()
	{
		$this->call('GET', 'v1.0/user/1');
		$this->assertResponseOk();
	}

}
