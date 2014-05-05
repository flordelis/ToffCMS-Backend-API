<?php

class GalleryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$galleries = Gallery::with('items')->get();

		return static::response('galleries', $galleries->toArray());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$gallery = new Gallery;

		// Set up the validator
		$validator = $gallery->validate(Input::all());
		if ($validator->fails())
		{
			return static::response('message', $validator->messages()->all(), true);
		}

		$gallery->title = Input::get('title');
		$gallery->slug = Input::get('slug');
		$gallery->save();

		return static::response('gallery', $gallery->toArray());
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$gallery = Gallery::where('slug', $slug)
					->with('items')
					->take(1)
					->first();

		if ($gallery === NULL)
		{
			return static::response('message', 'Gallery with this slug doesn\'t exist.', true);
		}

		return static::response('gallery', $gallery->toArray());
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$gallery = Gallery::find($id);

		// Does the item exist?
		if ($gallery === null || $gallery->exists() === false)
		{
			return static::response('message', 'Gallery with this ID doesn\'t exist.', true);
		}

		// Validate the input
		$validator = $gallery->validate(Input::all());
		if ($validator->fails())
		{
			return static::response('message', $validator->messages()->all(), true);
		}

		// Set the input
		$gallery->title = Input::get('title');
		$gallery->slug = Input::get('slug');

		// Save
		$gallery->save();

		return static::response('gallery', $gallery->toArray());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Gallery::destroy($id);
		return static::response('status', true);
	}


}
