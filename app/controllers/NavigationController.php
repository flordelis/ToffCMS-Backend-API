<?php

class NavigationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$nav = Navigation::where('language', Input::get('language', 'en'))
					->orderBy('order_id')
					->get();

		return static::response('navigation', $nav->toArray());
	}


}
