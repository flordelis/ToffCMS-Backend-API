<?php

class LoginControllerTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('UserTableSeeder');
	}

	public function testGetApiKeySuccess()
	{
		$this->call('POST', 'v1.0/login', array(
			'email' => 'mja@mja.lv',
			'password' => 'password',
		));
		$this->assertResponseOk();
	}

	/**
	 * @expectedException Symfony\Component\Security\Core\Exception\AuthenticationException
	 */
	public function testGetApiKeyFail()
	{
		$this->call('POST', 'v1.0/login', array(
			'email' => 'mja@mja.lv',
			'password' => 'wrong password',
		));
	}

}
