<?php

class NavigationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$nav = Navigation::where('parent_id', 0)
					->with('children')
					->orderBy('order_id')
					->get();

		return static::response('navigation', $nav->toArray());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Set up the validator
		$validator = Navigation::validate(Input::all());
		if ($validator->fails())
		{
			return static::response('message', $validator->messages()->all(), true);
		}

		$nav = new Navigation;
		$nav->title = Input::get('title');
		$nav->type = Input::get('type');
		$nav->uri = Input::get('uri');
		$nav->page_id = Input::get('page_id');
		$nav->url = Input::get('url');
		$nav->target = Input::get('target');
		$nav->language = Input::get('language');

		$nav->save();

		return static::response('page', $nav->toArray());
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string $language
	 * @return Response
	 */
	public function show($language)
	{
		$nav = Navigation::where('language', $language)
					->where('parent_id', 0)
					->with('children')
					->orderBy('order_id')
					->get();

		return static::response('navigation', $nav->toArray());
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nav = Navigation::find($id);

		// Does the item exist?
		if ($nav->exists() === false)
		{
			return static::response('message', 'Navigation instance with this ID doesn\'t exist.', true);
		}

		// Validate the input
		$validator = Navigation::validate(Input::all(), 'update');
		if ($validator->fails())
		{
			return static::response('message', $validator->messages()->all(), true);
		}

		// Set the input
		$nav->title = Input::get('title');
		$nav->type = Input::get('type');
		$nav->uri = Input::get('uri');
		$nav->page_id = Input::get('page_id');
		$nav->url = Input::get('url');
		$nav->target = Input::get('target');
		$nav->language = Input::get('language');

		// Save
		$nav->save();

		return static::response('page', $nav->toArray());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Navigation::destroy($id);
		return static::response('status', true);
	}

}
