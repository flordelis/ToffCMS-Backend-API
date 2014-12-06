<?php

class ImageController extends Controller {

	/**
	 * Get and return a single image
	 *
	 * @return Response
	 */
	public function original($filename)
	{
		$path = Config::get('assets.images.paths.input') . $filename;
		$file = new Symfony\Component\HttpFoundation\File\File($path);

		return static::response(
			File::get($path),
			$file->getMimeType()
		);
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
		return static::response(
			Image::resize($filename, $size),
			Image::getMimeType($filename)
		);
	}

	/**
	 * Build the response output
	 * @param  object $data
	 * @param  string $mimeType
	 * @return Response
	 */
	public function response($data, $mimeType)
	{
		$response = Response::make($data, 200);
		$response->header('content-type', $mimeType);
		return $response;
	}

}
