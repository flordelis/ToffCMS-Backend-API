<?php

class Page extends Eloquent {

	protected $table = 'pages';
	protected $hidden = array('updated_at', 'author_id');

	public function author()
	{
		return $this->hasOne('User', 'id', 'author_id')
					->select('id', 'email');
	}

	public function getAuthorIdAttribute($value)
	{
		return (int) $value;
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

}
