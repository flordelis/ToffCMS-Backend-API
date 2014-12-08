<?php

class GalleryItemRepository extends Repository {

    protected static $model = 'Gallery_Item';

    /**
     * Update the item order
     * @param  array  $items
     * @return boolean
     */
    public static function updateOrder(array $items)
    {
        $index = 0;

        foreach ($items as $row)
        {
            Gallery_Item::where('id', '=', $row['id'])
                        ->update(array('order_id' => ++$index));
        }

        return true;
    }

    /**
     * Create a new object.
     * @param  Gallery $gallery
     * @param  string  $filename
     * @return Object
     */
    public function createWithUpload($gallery, $filename)
    {
        $input = array(
            'gallery_id' => $gallery->id,
            'content' => $filename,
            'type' => 'image',
        );

        return $this->create($input);
    }

    /**
     * Upload a file
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return string
     */
    public function upload(\Symfony\Component\HttpFoundation\File\UploadedFile $file)
    {
        static::getModel()->validateOrFail(array('file' => $file), 'file');

        $filename = str_random(8) . '.' . $file->guessExtension();

        $file->move(
            Config::get('assets.images.paths.input'),
            $filename
        );

        return $filename;
    }

    public function delete($id)
    {
        $item = Gallery_Item::findOrFail($id);

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

        return parent::delete($id);
    }
}
