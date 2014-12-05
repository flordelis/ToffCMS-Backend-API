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

	/**
	 * @return void
	 */
	public function testIndex()
	{
		$this->call('GET', 'v1.0/page');
		$this->assertResponseOk();
	}

	/**
	 * @return void
	 */
	public function testShow()
	{
		$this->call('GET', 'v1.0/page/test');
		$this->assertResponseOk();
	}

	/**
	 * @return void
	 */
	// public function testStoreSuccess()
	// {
	// 	$this->call('POST', 'v1.0/page', array(
	// 		'title' => 'Hello World',
	// 		'slug' => 'hello-world',
	// 		'body' => 'Lorem ipsum dolor sit amet',
	// 	));
	// 	$this->assertResponseOk();
	// }

	/**
	 * Attempt to update without a slug field.
	 * This should result in a validation error.
	 * @return void
	 */
	public function testStoreFail()
	{
		$this->call('POST', 'v1.0/page', array(
			'title' => 'Hello World',
			'body' => 'Lorem ipsum dolor sit amet',
		));
		$this->assertResponseStatus(Status::HTTP_NOT_ACCEPTABLE);
	}

	/**
	 * @return void
	 */
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
	 * Attempt to update without a slug field.
	 * This should result in a validation error.
     * @dataProvider testUpdateFailData
	 * @return void
     */
	public function testUpdateFail($id, $exists = true)
	{
		$this->call('PATCH', 'v1.0/page/' . $id, array(
			'title' => 'Hello World',
			'body' => 'Lorem ipsum dolor sit amet',
			'status' => 'live',
			'language' => 'en',
		));
		$this->assertResponseStatus($exists ? Status::HTTP_NOT_ACCEPTABLE : Status::HTTP_NOT_FOUND);
	}

	/**
	 * @return void
	 */
	public function testDestroy()
	{
		$this->call('DELETE', 'v1.0/page/1');
		$this->assertResponseOk();
	}

	/**
	 * Data used for update tests.
	 * @return array
	 */
	public function testUpdateFailData()
	{
		return array(
			array(1),
			array(99, false),
		);
	}
}
