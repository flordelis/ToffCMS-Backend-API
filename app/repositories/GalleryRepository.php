<?php

/**
 * Gallery repository.
 */
class GalleryRepository extends Repository
{
    protected static $model = 'Gallery';

    /**
     * Find galleries with the items.
     *
     * @return [Gallery]
     */
    public static function findWithItems()
    {
        return Gallery::with(
            array('items' => function ($query) {
                $query->orderBy('order_id');
            })
        )->get();
    }

    /**
     * Find the gallery by slug.
     *
     * @param string $slug Slug of the row to be retrieved.
     *
     * @return Gallery
     */
    public function findBySlug($slug)
    {
        return Gallery::where('slug', $slug)
            ->with(
                array('items' => function ($query) {
                    $query->orderBy('order_id');
                })
            )
                ->take(1)
                ->firstOrFail();
    }

    /**
     * Update a gallery.
     *
     * @param integer $id    Primary key of the row to be updated.
     * @param array   $input Posted input.
     *
     * @throws ValidationException If validation has failed.
     * @return Page
     */
    public function update($id, array $input)
    {
        $gallery = static::getModel()->findOrFail($id);

        $validator = Validator::make($input, $gallery->getUpdateRules());
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $gallery->save($input);
        return $gallery;
    }
}
