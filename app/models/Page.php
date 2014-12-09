<?php

/**
 * Page model.
 */
class Page extends EloquentExtension
{
    protected $table = 'pages';
    protected $hidden = array('updated_at', 'author_id');
    public static $rules = array(
        'default' => array(
            'title'        => array('required', 'max:100'),
            'slug'         => array('required', 'max:100', 'unique:pages,slug,null,id,language,en'),
            'status'       => array('in:draft,live'),
            'language'     => array('in:lv,en,ru'),
            'body'         => array('required')
        ),
        'update' => array(
            'slug'         => array('required', 'max:100'),
        ),
    );

    /**
     * Grabt the rules.
     *
     * @param string $key Key of the rules.
     *
     * @return array
     */
    public static function getRules($key = null)
    {
        $rules = parent::getRules($key);

        // Append an extra (dynamic) rule
        $rules['slug'][] = 'unique:pages,slug,null,id,language,'. Input::get('language');

        return $rules;
    }

    /**
     * Get the author of this page.
     *
     * @return User
     */
    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id')
            ->select('id', 'email');
    }

    /**
     * Get authors ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getAuthorIdAttribute($value)
    {
        return (int) $value;
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
}
