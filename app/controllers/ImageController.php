<?php

class ImageController extends BaseController {

	/**
	 * Get and return a single image
	 *
	 * @return Response
	 */
	public function original($filename)
	{
		$path = Config::get('assets.images.paths.input') . $filename;
		$file = new Symfony\Component\HttpFoundation\File\File($path);

		$response = Response::make(
			File::get($path),
			200
		);

		$response->header(
			'Content-type',
			$file->getMimeType()
		);

		return $response;
	}


	/**
	 * Resize an image
	 *
	 * @param  string $size
	 * @param  string $filename
	 * @return Response
	 */
	public function resize($size, $filename)
	{
		$response = Response::make(
			Image::resize($filename, $size),
			200
		);

		$response->header(
			'content-type',
			Image::getMimeType($filename)
		);

		return $response;
	}


}
