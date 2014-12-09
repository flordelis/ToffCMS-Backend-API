<?php

/**
 * Base API controller.
 */
class BaseController extends Controller
{
    /**
     * Return the response in an appropriate format.
     *
     * @param mixed   $data   Data that will be returned.
     * @param integer $status Status code to be returned.
     *
     * @return Response
     */
    protected static function response($data, $status = Status::HTTP_OK)
    {
        return Response::json(
            array(
                'error' => $status !== Status::HTTP_OK,
                'data' => $data,
                'count' => count($data)
            ),
            $status
        );
    }
}
