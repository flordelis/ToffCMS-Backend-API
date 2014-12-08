<?php

class GalleryController extends BaseController
{

    protected $gallery;

    /**
     * Constructor
     * @param GalleryRepository $gallery
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
     * @param  string $slug
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
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->gallery->delete($id);
        return static::response(true);
    }


}
