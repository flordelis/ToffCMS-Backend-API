<?php

class UserTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('UserTableSeeder');
	}

	public function testValidAPIKey()
	{
		$user = User::find(1);

		$this->assertFalse(User::validAPIKey('invalid key', $user->id));
		$this->assertTrue(User::validAPIKey($user->api_key, $user->id));
	}

	public function testGetCurrent()
	{
		$this->assertTrue(User::getCurrent() instanceof User);
	}

}
