<?php

class Gallery_Item extends Eloquent {

	protected $table = 'gallery_items';
	protected $hidden = array('created_at', 'updated_at', 'gallery_id');
	public static $rules = array(
		'file' => array(
			'file' => array('required|mimes:jpeg,png,jpg|image|max:2048'),
		),
	);

	public function gallery()
	{
		return $this->belongsTo('Gallery');
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

	public function getGalleryIdAttribute($value)
	{
		return (int) $value;
	}

	/**
	 * Delete an image - both from DB and cache
	 * @param  integer $id
	 */
	public static function destroy($id)
	{
		$item = self::find($id);

		if ($item->exists())
		{
			// In case this is an image - delete cache
			if ($item->type === 'image')
			{
				// Delete the main image
				File::delete(Config::get('assets.images.paths.input') . $item->content);

				// Delete resized images
				foreach (Config::get('assets.images.sizes') as $size => $data)
				{
					File::delete(Config::get('assets.images.paths.output') . $size . '_' . $item->content);
				}
			}
		}

		return parent::destroy($id);
	}

}
