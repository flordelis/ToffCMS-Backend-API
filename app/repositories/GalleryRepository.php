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
}
