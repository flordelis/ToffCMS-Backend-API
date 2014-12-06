<?php

class Gallery_Item extends Eloquent {

	protected $table = 'gallery_items';
	protected $hidden = array('created_at', 'updated_at', 'gallery_id');
	public static $rules = array(
		'file' => array(
			'file' => array('required|mimes:jpeg,png,jpg|image|max:2048'),
		),
	);

	public function gallery()
	{
		return $this->belongsTo('Gallery');
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

	public function getGalleryIdAttribute($value)
	{
		return (int) $value;
	}

}
