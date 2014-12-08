<?php

class Gallery extends EloquentExtension {

    protected $table = 'gallery';
    protected $hidden = array('updated_at', 'status');
    public static $rules = array(
        'default' => array(
            'title'        => array('required', 'max:100'),
            'slug'         => array('required', 'max:100'),
            'status'       => array('in:draft,live'),
        ),
    );

    /**
     * Grab the rules.
     * @param  string $key
     * @return array
     */
    public function getUpdateRules()
    {
        $rules = parent::getRules('update');
        $rules['slug'][] = 'unique:gallery,slug,' . $this->id;
        return $rules;
    }

    public function items()
    {
        return $this->hasMany('Gallery_Item');
    }

    public function getIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Delete the gallery and images
     * @param  integer $id
     */
    public static function destroy($id)
    {
        $gallery = self::find($id);

        if ($gallery->exists())
        {
            $items = Gallery_Item::where('gallery_id', '=', $gallery->id)->get();

            foreach ($items as $item)
            {
                Gallery_Item::destroy($item->id);
            }
        }

        return parent::destroy($id);
    }
}
