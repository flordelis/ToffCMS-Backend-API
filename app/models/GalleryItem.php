<?php

/**
 * Gallery item model.
 */
class GalleryItem extends EloquentExtension
{
    protected $table = 'gallery_items';
    protected $hidden = array('created_at', 'updated_at', 'gallery_id');
    public static $rules = array(
        'file' => array(
            'file' => array('required', 'mimes:jpeg,png,jpg,gif', 'image', 'max:2048'),
        ),
    );

    /**
     * Get the gallery attached to this item.
     *
     * @return Gallery
     */
    public function gallery()
    {
        return $this->belongsTo('Gallery');
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
     * Get Gallery ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getGalleryIdAttribute($value)
    {
        return (int) $value;
    }
}
