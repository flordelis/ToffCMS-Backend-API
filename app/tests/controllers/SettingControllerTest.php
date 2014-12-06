<?php

class SettingControllerTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('SettingTableSeeder');
	}

	public function testIndex()
	{
		$this->call('GET', 'v1.0/settings');
		$this->assertResponseOk();
	}

	public function testFrontend()
	{
		$this->call('GET', 'v1.0/settings/frontend');
		$this->assertResponseOk();
	}

}
