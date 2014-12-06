<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends BaseController {

	protected $page;

	/**
	 * Constructor
	 * @param PageRepository $page
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
	 * @param  string $slug
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
	 * @param  int  $id
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->page->delete($id);
		return static::response(true);
	}


}
