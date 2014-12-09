<?php

/**
 * Gallery management.
 */
class GalleryController extends BaseController
{
    protected $gallery;

    /**
     * Constructor.
     *
     * @param GalleryRepository $gallery Gallery repository.
     */
    public function __construct(GalleryRepository $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $galleries = $this->gallery->findWithItems();
        return static::response($galleries->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $gallery = $this->gallery->create(Input::all());
        return static::response($gallery->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param string $slug Slug of the gallery.
     *
     * @return Response
     */
    public function show($slug)
    {
        $gallery = $this->gallery->findBySlug($slug);
        return static::response($gallery->toArray());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param integer $id Primary key of a gallery.
     *
     * @return Response
     */
    public function update($id)
    {
        $gallery = $this->gallery->update($id, Input::all());
        return static::response($gallery->toArray());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id Primary key of a gallery.
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->gallery->delete($id);
        return static::response(true);
    }
}
