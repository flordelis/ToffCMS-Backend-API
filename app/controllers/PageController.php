<?php

/**
 * Page management.
 */
class PageController extends BaseController
{
    protected $page;

    /**
     * Constructor.
     *
     * @param PageRepository $page Page repository.
     */
    public function __construct(PageRepository $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = $this->page->getWithAuthor();
        return static::response($page->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $page = $this->page->create(Input::all());
        return static::response($page->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param string $slug Slug of the post to be shown.
     *
     * @return Response
     */
    public function show($slug)
    {
        $page = $this->page->getForShow($slug, Input::get('language'));
        return static::response($page->toArray());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param integer $id Primary key of the post.
     *
     * @return Response
     */
    public function update($id)
    {
        $page = $this->page->update($id, Input::all());
        return static::response($page->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id Primary key of the post.
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->page->delete($id);
        return static::response(true);
    }
}
