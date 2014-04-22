<?php

class Navigation extends Eloquent {

	protected $table = 'navigation';
	protected $hidden = array('creted_at', 'updated_at');

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

	public function getPageIdAttribute($value)
	{
		return (int) $value;
	}

	public function getOrderIdAttribute($value)
	{
		return (int) $value;
	}

}
