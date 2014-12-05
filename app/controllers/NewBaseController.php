<?php

class NewBaseController extends Controller {

	protected static function response($data, $error = Status::HTTP_OK)
	{
		return Response::json(array(
			'error' => $error !== Status::HTTP_OK,
			'data' => $data,
			'count' => count($data),
		), $error);
	}

}
