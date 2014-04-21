<?php

class Gallery extends \Eloquent {

	protected $table = 'gallery';
	protected $hidden = array('updated_at', 'status');

	public function items()
	{
		return $this->hasMany('Gallery_Item');
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

}
