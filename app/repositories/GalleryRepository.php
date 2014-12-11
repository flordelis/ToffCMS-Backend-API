<?php

/**
 * Gallery repository.
 */
class GalleryRepository extends Repository
{
    /**
     * Constructor.
     *
     * @param Gallery $model Gallery model.
     */
    public function __construct(Gallery $model)
    {
        $this->model = $model;
    }

    /**
     * Find galleries with the items.
     *
     * @return [Gallery]
     */
    public function findWithItems()
    {
        return $this->getModel()
            ->with(
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
        return $this->getModel()
            ->where('slug', $slug)
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
        $gallery = $this->getModel()->findOrFail($id);

        $validator = Validator::make($input, $gallery->getUpdateRules());
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $gallery->save($input);
        return $gallery;
    }
}
