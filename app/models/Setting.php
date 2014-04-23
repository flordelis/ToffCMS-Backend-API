<?php

class Setting extends Eloquent {

	protected $table = 'settings';
	protected $visible = array('key', 'value');

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

	public function getValueAttribute($value)
	{
		return empty($value) ? $this->attributes['default'] : $value;
	}

}
