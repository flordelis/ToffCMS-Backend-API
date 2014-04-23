<?php

class Navigation extends Eloquent {

	protected $table = 'navigation';
	protected $hidden = array('page_id', 'url', 'uri', 'created_at', 'updated_at', 'page', 'parent_id');
	protected $appends = array('full_url');

	public function page()
	{
		return $this->hasOne('Page', 'id', 'page_id');
	}

	/**
	 * Get the children of this navigation instance
	 * @return array
	 */
	public function children()
	{
		return $this->hasMany('Navigation', 'parent_id', 'id');
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

	public function getPageIdAttribute($value)
	{
		return (int) $value;
	}

	public function getParentIdAttribute($value)
	{
		return (int) $value;
	}

	public function getOrderIdAttribute($value)
	{
		return (int) $value;
	}

	public function getFullUrlAttribute()
	{
		switch ($this->attributes['type'])
		{
			case 'uri':
				return $this->attributes['uri'];

			case 'website':
				return $this->attributes['url'];

			case 'page':
				return '/' . $this->page->slug;

			default:
				throw new Exception("Error Processing Request");
		}
	}

}
