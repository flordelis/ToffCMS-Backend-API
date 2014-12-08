<?php

class Navigation extends EloquentExtension {

    protected $table = 'navigation';
    protected $hidden = array('order_id', 'created_at', 'updated_at', 'page', 'parent_id');
    protected $appends = array('full_url');
    public static $rules = array(
        'default' => array(
            'title'        => array('required', 'max:100'),
            'uri'          => array('max:250'),
            'page_id'      => array('integer'),
            'url'          => array('max:250'),
            'target'       => array('in:,_blank'),
            'type'         => array('required', 'in:uri,page,website'),
            'language'     => array('required', 'in:lv,en,ru'),
        ),
    );

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
                return '/'. ltrim($this->attributes['uri'], '/');

            case 'website':
                return $this->attributes['url'];

            case 'page':
                if ($this->page === null) {
                    return null;
                }

                return '/' . $this->page->slug;

            default:
                throw new Exception("Error Processing Request");
        }
    }

}
