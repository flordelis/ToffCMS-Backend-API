<?php

class GalleryItemController extends BaseController {

    protected $item;
    protected $gallery;

    /**
     * Constructor
     * @param GalleryItemRepository $item
     * @param GalleryRepository     $gallery
     */
    public function __construct(
        GalleryItemRepository $item,
        GalleryRepository $gallery
    ) {
        $this->item = $item;
        $this->gallery = $gallery;
    }

    /**
     * Upload an image
     *
     * @return Response
     */
    public function upload()
    {
        $gallery = $this->gallery->findOrFail(Input::get('id'));

        $file = Input::file('file');
        $filename = $this->item->upload($file);

        $item = $this->item->createWithUpload($gallery, $filename);
        return static::response($item->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->item->delete($id);
        return static::response(true);
    }

    /**
     * Save the order
     * @return Response
     */
    public function saveOrder()
    {
        $this->item->updateOrder(Input::get('data'));
        return static::response('Successfully saved the order');
    }

}
