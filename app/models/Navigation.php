<?php

/**
 * Navigation model.
 */
class Navigation extends EloquentExtension
{
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

    /**
     * Grab the page.
     *
     * @return Page
     */
    public function page()
    {
        return $this->hasOne('Page', 'id', 'page_id');
    }

    /**
     * Get the children of this navigation instance.
     *
     * @return array
     */
    public function children()
    {
        return $this->hasMany('Navigation', 'parent_id', 'id');
    }

    /**
     * Get ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get page ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getPageIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get parent ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getParentIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get order ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getOrderIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get the fully formated URL.
     *
     * @throws Exception If invalid type attr is set.
     * @return string
     */
    public function getFullUrlAttribute()
    {
        switch ($this->attributes['type']) {
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
