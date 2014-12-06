<?php

class GalleryItemControllerTest extends TestCase {

	/**
	 * Set the seeds
	 */
	public function setUp()
	{
		parent::setUp();

		Eloquent::unguard();
		$this->seed('GalleryTableSeeder');
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function testUploadFailNotFoundGallery()
	{
		$this->call('POST', 'v1.0/gallery/item/upload', array(
			'id' => 1000,
		));
	}

	public function testDestroy()
	{
		$this->call('DELETE', 'v1.0/gallery/item/1');
		$this->assertResponseOk();
	}

	public function testSaveOrder()
	{
		$this->call('PUT', 'v1.0/gallery/item/order', array(
			'data' => array(
				array('id' => 3),
				array('id' => 2),
				array('id' => 1),
			),
		));
		$this->assertResponseOk();
	}
}
