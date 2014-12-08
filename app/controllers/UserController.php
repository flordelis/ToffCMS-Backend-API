<?php

/**
 * User management
 *
 * PHP version 5
 *
 * @category API
 * @package  ToffCMS
 * @author   Matiss Janis Aboltins <matiss@mja.lv>
 * @link     http://www.mja.lv/
 */
class UserController extends BaseController
{
    protected $user;

    /**
     * Constructor
     * @param UserRepository $user User repository
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display the specified resource.
     * @param  int $id Primary key of the user to be retrieved
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        return static::response($user->toArray());
    }
}
