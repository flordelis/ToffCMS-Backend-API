<?php

/**
 * Gallery item repository.
 */
class GalleryItemRepository extends Repository
{
    protected static $model = 'GalleryItem';

    /**
     * Update the item order.
     *
     * @param array $items Items that will be updated.
     *
     * @return boolean
     */
    public static function updateOrder(array $items)
    {
        $index = 0;

        foreach ($items as $row) {
            GalleryItem::where('id', '=', $row['id'])
                        ->update(array('order_id' => ++$index));
        }

        return true;
    }

    /**
     * Create a new object.
     *
     * @param Gallery $gallery  Gallery.
     * @param string  $filename Filename.
     *
     * @return Class
     */
    public function createWithUpload(Gallery $gallery, $filename)
    {
        $input = array(
            'gallery_id' => $gallery->id,
            'content' => $filename,
            'type' => 'image',
        );

        return $this->create($input);
    }

    /**
     * Upload a file.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file File to be updated.
     *
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

    /**
     * Delete a gallery item.
     *
     * @param integer $id Primary key.
     *
     * @return boolean
     */
    public function delete($id)
    {
        $item = GalleryItem::findOrFail($id);

        // In case this is an image - delete cache
        if ($item->type === 'image') {
            // Delete the main image
            File::delete(Config::get('assets.images.paths.input') . $item->content);

            // Delete resized images
            foreach (Config::get('assets.images.sizes') as $size => $data) {
                File::delete(Config::get('assets.images.paths.output') . $size . '_' . $item->content);
            }
        }

        return parent::delete($id);
    }
}
