<?php

use Symfony\Component\HttpFoundation\Response;

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
	public function testUpdateSuccess()
	{
		$page = Page::first();
		$this->call('PATCH', 'v1.0/page/' . $page->id, array(
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
	 * @return void
	 */
	public function testUpdateFail()
	{
		$page = Page::first();
		$this->call('PATCH', 'v1.0/page/' . $page->id, array(
			'title' => 'Hello World',
			'body' => 'Lorem ipsum dolor sit amet',
			'status' => 'live',
			'language' => 'en',
		));
		$this->assertResponseStatus(Response::HTTP_NOT_ACCEPTABLE);
	}

	/**
	 * @return void
	 */
	public function testDestroy()
	{
		$page = Page::first();
		$this->call('DELETE', 'v1.0/page/' . $page->id);
		$this->assertResponseOk();
	}
}
