<?php

class NavigationTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('UserTableSeeder');
		$this->seed('PageTableSeeder');
		$this->seed('NavigationTableSeeder');
	}

	public function testGetOrderIdAttribute()
	{
		$nav = new Navigation(array('order_id' => 5));
		$this->assertSame($nav->order_id, 5);
	}

	public function testTypeWebsite()
	{
		$nav = new Navigation(array(
			'type' => 'website',
			'url' => 'http://google.com',
		));

		$this->assertSame($nav->getFullUrlAttribute(), 'http://google.com');
	}

	public function testTypeUri()
	{
		$nav = new Navigation(array(
			'type' => 'uri',
			'uri' => '/gallery/',
		));

		$this->assertSame($nav->getFullUrlAttribute(), '/gallery/');
	}

	public function testTypePage()
	{
		$page = Page::find(1);
		$nav = new Navigation(array(
			'type' => 'page',
			'page_id' => $page->id,
		));

		$this->assertSame($nav->getFullUrlAttribute(), '/' . $page->slug);

		$nav->page = null;
		$this->assertSame($nav->getFullUrlAttribute(), null);
	}

	/**
	 * @expectedException Exception
	 */
	public function testTypeFail()
	{
		$nav = new Navigation(array(
			'type' => 'fail',
		));
		$nav->getFullUrlAttribute();
	}

}
