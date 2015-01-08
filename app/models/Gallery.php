<?php

/**
 * Gallery model.
 */
class Gallery extends EloquentExtension
{
    protected $table = 'gallery';
    protected $hidden = array('updated_at', 'status');
    protected $fillable = array('title', 'slug', 'status');
    public static $rules = array(
        'default' => array(
            'title'        => array('required', 'max:100'),
            'slug'         => array('required', 'max:100'),
            'status'       => array('in:draft,live'),
        ),
    );

    /**
     * Grab the rules.
     *
     * @return array
     */
    public static function getRules($key = null)
    {
        $rules = parent::getRules($key);

        // Append an extra (dynamic) rule
        if ($key === 'update') {
            $rules['slug'][] = 'unique:gallery,slug,' . Input::get('id');
        } else {
            $rules['slug'][] = 'unique:gallery,slug';
        }

        return $rules;
    }

    /**
     * Get the gallery items.
     *
     * @return [GalleryItem]
     */
    public function items()
    {
        return $this->hasMany('GalleryItem');
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
     * Delete the gallery and images.
     *
     * @param integer $id Primary key.
     *
     * @return boolean
     */
    public static function destroy($id)
    {
        $gallery = self::find($id);

        if ($gallery->exists()) {
            $items = GalleryItem::where('gallery_id', '=', $gallery->id)->get();

            foreach ($items as $item) {
                GalleryItem::destroy($item->id);
            }
        }

        return parent::destroy($id);
    }
}
