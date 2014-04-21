<?php

class PageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// $page = new Page;
		// $page->title = Request::get('title');
		// $page->slug = Request::get('slug');
		// $page->body = Request::get('body');
		// $page->status = Request::get('status');
		// $page->author_id = Auth::user()->id;

		// // !!! ToDo: validation

		// $page->save();

		// return static::response('message', ''); // !!! ToDo
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$page = Page::where('slug', $slug)
					->with('author')
					->take(1)
					->get();

		return static::response('pages', $page->toArray());
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
