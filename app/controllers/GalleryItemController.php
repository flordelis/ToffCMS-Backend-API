<?php

class GalleryItemController extends \BaseController {

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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Upload an image
	 *
	 * @return Response
	 */
	public function upload()
	{
		$gallery = Gallery::find(Input::get('id'));

		if ($gallery->exists() === FALSE)
		{
			return static::response('message', 'Gallery with the given ID doesn\'t exist.', true);
		}

		$destinationPath = Config::get('assets.images.paths.input');
		$file = Input::file('file');

		if (!is_a($file, 'Symfony\Component\HttpFoundation\File\UploadedFile'))
		{
			return static::response('message', 'Unknown error occurred.', true);
		}

		$validator = Validator::make(
			array('file' => $file),
			array('file' => 'required|mimes:jpeg,png,jpg|image|max:2048')
		);

		if ($validator->passes() === false)
		{
			return static::response('message', $validator->messages()->all(), true);
		}

		$filename = str_random(8) . '.' . $file->guessExtension();

		$status = $file->move(
			Config::get('assets.images.paths.input'),
			$filename
		);

		if ($status)
		{
			$item = new Gallery_Item;
			$item->gallery_id = $gallery->id;
			$item->content = $filename;
			$item->type = 'image';
			$item->save();

		   return static::response('item', $item->toArray());
		}
		else
		{
		   return static::response('message', 'File upload failed', true);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
