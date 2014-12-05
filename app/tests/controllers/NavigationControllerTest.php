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

	/**
	 * @return void
	 */
	public function testIndex()
	{
		$this->call('GET', 'v1.0/navigation');
		$this->assertResponseOk();
	}

	/**
	 * Save the order of navigation
	 * @return void
	 */
	public function testSaveOrder()
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
	 * @return void
	 */
	public function testShow()
	{
		$this->call('GET', 'v1.0/navigation/en');
		$this->assertResponseOk();
	}

	/**
	 * @return void
	 */
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
	 * Attempt to update without a slug field.
	 * This should result in a validation error.
     * @dataProvider testUpdateFailData
	 * @return void
     */
	public function testUpdateFail($id, $exists = true)
	{
		$this->call('PATCH', 'v1.0/navigation/' . $id, array(
			'type' => 'website',
			'language' => 'en',
		));
		$this->assertResponseStatus($exists ? Status::HTTP_NOT_ACCEPTABLE : Status::HTTP_NOT_FOUND);
	}

	/**
	 * @return void
	 */
	public function testDestroy()
	{
		$this->call('DELETE', 'v1.0/navigation/1');
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
