<?php

/**
 * Uploaded image viewing and resizing.
 */
class ImageController extends Controller
{
    /**
     * Get and return a single image.
     *
     * @param string $filename The filename of file to be displayed.
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
     * Resize an image.
     *
     * @param string $size     The chosen size of the image.
     * @param string $filename The filename of file to be displayed.
     *
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
     * Build the response output.
     *
     * @param object $data     Output the file.
     * @param string $mimeType The mimetype of the output.
     *
     * @return Response
     */
    public function response($data, $mimeType)
    {
        $response = Response::make($data, 200);
        $response->header('content-type', $mimeType);
        return $response;
    }
}
