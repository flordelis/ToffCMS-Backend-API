<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected static function response($key, $data, $error = FALSE)
	{
		return Response::json(array(
			'error' => $error,
			$key => $data),
			($error ? 500 : 200)
		);
	}

}
